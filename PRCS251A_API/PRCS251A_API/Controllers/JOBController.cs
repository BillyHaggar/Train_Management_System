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
    public class JOBController : ApiController
    {
        private Entities db = new Entities();

        // GET: api/JOB
        public IQueryable<JOB> GetJOBs()
        {
            return db.JOBs;
        }

        // GET: api/JOB/5
        [ResponseType(typeof(JOB))]
        public IHttpActionResult GetJOB(decimal id)
        {
            JOB jOB = db.JOBs.Find(id);
            if (jOB == null)
            {
                return NotFound();
            }

            return Ok(jOB);
        }

        // PUT: api/JOB/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutJOB(decimal id, JOB jOB)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != jOB.JOB_ID)
            {
                return BadRequest();
            }

            db.Entry(jOB).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!JOBExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return StatusCode(HttpStatusCode.Accepted);
        }

        // POST: api/JOB
        [ResponseType(typeof(JOB))]
        public IHttpActionResult PostJOB(JOB jOB)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.JOBs.Add(jOB);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (JOBExists(jOB.JOB_ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = jOB.JOB_ID }, jOB);
        }

        // DELETE: api/JOB/5
        [ResponseType(typeof(JOB))]
        public IHttpActionResult DeleteJOB(decimal id)
        {
            JOB jOB = db.JOBs.Find(id);
            if (jOB == null)
            {
                return NotFound();
            }

            db.JOBs.Remove(jOB);
            db.SaveChanges();

            return Ok(jOB);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool JOBExists(decimal id)
        {
            return db.JOBs.Count(e => e.JOB_ID == id) > 0;
        }
    }
}