using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Data.Entity.Validation;
using System.Diagnostics;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Description;
using PRCS251A_API.Models;

namespace PRCS251A_API.Controllers
{
    public class ROUTE_NUMController : ApiController
    {
        private Entities db = new Entities();

        // GET: api/ROUTE_NUM
        public IQueryable<ROUTE_NUM> GetROUTE_NUM()
        {
            return db.ROUTE_NUM;
        }

        // GET: api/ROUTE_NUM/5
        [ResponseType(typeof(ROUTE_NUM))]
        public IHttpActionResult GetROUTE_NUM(decimal id)
        {
            ROUTE_NUM rOUTE_NUM = db.ROUTE_NUM.Find(id);
            if (rOUTE_NUM == null)
            {
                return NotFound();
            }

            return Ok(rOUTE_NUM);
        }

        // PUT: api/ROUTE_NUM/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutROUTE_NUM(decimal id, ROUTE_NUM rOUTE_NUM)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != rOUTE_NUM.ROUTE_ID)
            {
                return BadRequest();
            }

            db.Entry(rOUTE_NUM).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!ROUTE_NUMExists(id))
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

        // POST: api/ROUTE_NUM
        [ResponseType(typeof(ROUTE_NUM))]
        public IHttpActionResult PostROUTE_NUM(ROUTE_NUM rOUTE_NUM)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.ROUTE_NUM.Add(rOUTE_NUM);

            try
            {
                db.SaveChanges();
            }
            catch (DbEntityValidationException e)
            {
                foreach (var eve in e.EntityValidationErrors)
                {
                    Debug.WriteLine("Entity of type \"{0}\" in state \"{1}\" has the following validation errors:",
                        eve.Entry.Entity.GetType().Name, eve.Entry.State);
                    foreach (var ve in eve.ValidationErrors)
                    {
                        Debug.WriteLine("- Property: \"{0}\", Error: \"{1}\"",
                            ve.PropertyName, ve.ErrorMessage);
                    }
                }
                throw;
            }
            catch (DbUpdateException)
            {
                if (ROUTE_NUMExists(rOUTE_NUM.ROUTE_ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = rOUTE_NUM.ROUTE_ID }, rOUTE_NUM);
        }

        // DELETE: api/ROUTE_NUM/5
        [ResponseType(typeof(ROUTE_NUM))]
        public IHttpActionResult DeleteROUTE_NUM(decimal id)
        {
            ROUTE_NUM rOUTE_NUM = db.ROUTE_NUM.Find(id);
            if (rOUTE_NUM == null)
            {
                return NotFound();
            }

            db.ROUTE_NUM.Remove(rOUTE_NUM);
            db.SaveChanges();

            return Ok(rOUTE_NUM);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool ROUTE_NUMExists(decimal id)
        {
            return db.ROUTE_NUM.Count(e => e.ROUTE_ID == id) > 0;
        }
    }
}