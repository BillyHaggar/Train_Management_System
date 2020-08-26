using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Data.Entity.Validation;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Description;
using PRCS251A_API.Models;
using System.Diagnostics;

namespace PRCS251A_API.Controllers
{
    public class TRANSACTION_LOGController : ApiController
    {
        private Entities db = new Entities();

        // GET: api/TRANSACTION_LOG
        public IQueryable<TRANSACTION_LOG> GetTRANSACTION_LOG()
        {
            return db.TRANSACTION_LOG;
        }

        // GET: api/TRANSACTION_LOG/5
        [ResponseType(typeof(TRANSACTION_LOG))]
        public IHttpActionResult GetTRANSACTION_LOG(decimal id)
        {
            TRANSACTION_LOG tRANSACTION_LOG = db.TRANSACTION_LOG.Find(id);
            if (tRANSACTION_LOG == null)
            {
                return NotFound();
            }

            return Ok(tRANSACTION_LOG);
        }

        // PUT: api/TRANSACTION_LOG/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutTRANSACTION_LOG(decimal id, TRANSACTION_LOG tRANSACTION_LOG)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != tRANSACTION_LOG.TRANSACTION_ID)
            {
                return BadRequest();
            }

            db.Entry(tRANSACTION_LOG).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!TRANSACTION_LOGExists(id))
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

        // POST: api/TRANSACTION_LOG
        [ResponseType(typeof(TRANSACTION_LOG))]
        public IHttpActionResult PostTRANSACTION_LOG(TRANSACTION_LOG tRANSACTION_LOG)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.TRANSACTION_LOG.Add(tRANSACTION_LOG);

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
                if (TRANSACTION_LOGExists(tRANSACTION_LOG.TRANSACTION_ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = tRANSACTION_LOG.TRANSACTION_ID }, tRANSACTION_LOG);
        }

        // DELETE: api/TRANSACTION_LOG/5
        [ResponseType(typeof(TRANSACTION_LOG))]
        public IHttpActionResult DeleteTRANSACTION_LOG(decimal id)
        {
            TRANSACTION_LOG tRANSACTION_LOG = db.TRANSACTION_LOG.Find(id);
            if (tRANSACTION_LOG == null)
            {
                return NotFound();
            }

            db.TRANSACTION_LOG.Remove(tRANSACTION_LOG);
            db.SaveChanges();

            return Ok(tRANSACTION_LOG);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool TRANSACTION_LOGExists(decimal id)
        {
            return db.TRANSACTION_LOG.Count(e => e.TRANSACTION_ID == id) > 0;
        }
    }
}