using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Description;
using PRCS251A_API.Models;

namespace PRCS251A_API.Controllers
{
    public class JOURNEYController : ApiController
    {
        private Entities db = new Entities();

        // GET: api/JOURNEYs
        public IQueryable<JOURNEY> GetJOURNEYs()
        {
            return db.JOURNEYs;
        }

        // GET: api/JOURNEYs/5
        [ResponseType(typeof(JOURNEY))]
        public IHttpActionResult GetJOURNEY(decimal id)
        {
            JOURNEY jOURNEY = db.JOURNEYs.Find(id);
            if (jOURNEY == null)
            {
                return NotFound();
            }

            return Ok(jOURNEY);
        }

        // PUT: api/JOURNEYs/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutJOURNEY(decimal id, JOURNEY jOURNEY)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != jOURNEY.JOURNEY_ID)
            {
                return BadRequest();
            }

            db.Entry(jOURNEY).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!JOURNEYExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return StatusCode(HttpStatusCode.NoContent);
        }

        // POST: api/JOURNEYs
        [ResponseType(typeof(JOURNEY))]
        public IHttpActionResult PostJOURNEY(JOURNEY jOURNEY)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.JOURNEYs.Add(jOURNEY);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (JOURNEYExists(jOURNEY.JOURNEY_ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = jOURNEY.JOURNEY_ID }, jOURNEY);
        }

        // DELETE: api/JOURNEYs/5
        [ResponseType(typeof(JOURNEY))]
        public IHttpActionResult DeleteJOURNEY(decimal id)
        {
            JOURNEY jOURNEY = db.JOURNEYs.Find(id);
            if (jOURNEY == null)
            {
                return NotFound();
            }

            db.JOURNEYs.Remove(jOURNEY);
            db.SaveChanges();

            return Ok(jOURNEY);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool JOURNEYExists(decimal id)
        {
            return db.JOURNEYs.Count(e => e.JOURNEY_ID == id) > 0;
        }
    }
}