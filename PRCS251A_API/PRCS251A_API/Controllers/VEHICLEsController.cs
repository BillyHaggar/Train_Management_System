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
    public class VEHICLEsController : ApiController
    {
        private Entities db = new Entities();

        // GET: api/VEHICLEs
        public IQueryable<VEHICLE> GetVEHICLEs()
        {
            return db.VEHICLEs;
        }

        // GET: api/VEHICLEs/5
        [ResponseType(typeof(VEHICLE))]
        public IHttpActionResult GetVEHICLE(string id)
        {
            VEHICLE vEHICLE = db.VEHICLEs.Find(id);
            if (vEHICLE == null)
            {
                return NotFound();
            }

            return Ok(vEHICLE);
        }

        // PUT: api/VEHICLEs/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutVEHICLE(string id, VEHICLE vEHICLE)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != vEHICLE.VEHICLE_REG)
            {
                return BadRequest();
            }

            db.Entry(vEHICLE).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!VEHICLEExists(id))
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

        // POST: api/VEHICLEs
        [ResponseType(typeof(VEHICLE))]
        public IHttpActionResult PostVEHICLE(VEHICLE vEHICLE)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.VEHICLEs.Add(vEHICLE);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (VEHICLEExists(vEHICLE.VEHICLE_REG))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = vEHICLE.VEHICLE_REG }, vEHICLE);
        }

        // DELETE: api/VEHICLEs/5
        [ResponseType(typeof(VEHICLE))]
        public IHttpActionResult DeleteVEHICLE(string id)
        {
            VEHICLE vEHICLE = db.VEHICLEs.Find(id);
            if (vEHICLE == null)
            {
                return NotFound();
            }

            db.VEHICLEs.Remove(vEHICLE);
            db.SaveChanges();

            return Ok(vEHICLE);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool VEHICLEExists(string id)
        {
            return db.VEHICLEs.Count(e => e.VEHICLE_REG == id) > 0;
        }
    }
}