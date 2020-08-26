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
    public class USER_ACCOUNTController : ApiController
    {
        private Entities db = new Entities();
       

        // GET: api/USER_ACCOUNT
        public IQueryable<USER_ACCOUNT> GetUSER_ACCOUNT()
        {

            return db.USER_ACCOUNT;
        }

        // GET: api/USER_ACCOUNT/5
        [ResponseType(typeof(USER_ACCOUNT))]
        public IHttpActionResult GetUSER_ACCOUNT(decimal id)
        {
            USER_ACCOUNT uSER_ACCOUNT = db.USER_ACCOUNT.Find(id);
            if (uSER_ACCOUNT == null)
            {
                return NotFound();
            }

            return Ok(uSER_ACCOUNT);
        }

        // PUT: api/USER_ACCOUNT/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutUSER_ACCOUNT(decimal id, USER_ACCOUNT uSER_ACCOUNT)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != uSER_ACCOUNT.USER_ID)
            {
                return BadRequest();
            }

            db.Entry(uSER_ACCOUNT).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!USER_ACCOUNTExists(id))
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

        // POST: api/USER_ACCOUNT
        [ResponseType(typeof(USER_ACCOUNT))]
        public IHttpActionResult PostUSER_ACCOUNT(USER_ACCOUNT uSER_ACCOUNT)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            db.USER_ACCOUNT.Add(uSER_ACCOUNT);

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateException)
            {
                if (USER_ACCOUNTExists(uSER_ACCOUNT.USER_ID))
                {
                    return Conflict();
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtRoute("DefaultApi", new { id = uSER_ACCOUNT.USER_ID }, uSER_ACCOUNT);
        }

        // DELETE: api/USER_ACCOUNT/5
        [ResponseType(typeof(USER_ACCOUNT))]
        public IHttpActionResult DeleteUSER_ACCOUNT(decimal id)
        {
            USER_ACCOUNT uSER_ACCOUNT = db.USER_ACCOUNT.Find(id);
            if (uSER_ACCOUNT == null)
            {
                return NotFound();
            }

            db.USER_ACCOUNT.Remove(uSER_ACCOUNT);
            db.SaveChanges();

            return Ok(uSER_ACCOUNT);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool USER_ACCOUNTExists(decimal id)
        {
            return db.USER_ACCOUNT.Count(e => e.USER_ID == id) > 0;
        }
    }
}