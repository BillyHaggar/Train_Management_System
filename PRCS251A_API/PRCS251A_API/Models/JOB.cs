//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated from a template.
//
//     Manual changes to this file may cause unexpected behavior in your application.
//     Manual changes to this file will be overwritten if the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

namespace PRCS251A_API.Models
{
    using System;
    using System.Collections.Generic;
    
    public partial class JOB
    {
        public decimal JOB_ID { get; set; }
        public Nullable<decimal> USER_ID { get; set; }
        public string JOB_DESCRIPTION { get; set; }
        public Nullable<decimal> JOURNEY_ID { get; set; }
        public System.DateTime JOB_DATE { get; set; }
    }
}