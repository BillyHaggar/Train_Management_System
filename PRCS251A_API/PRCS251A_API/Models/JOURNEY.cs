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
    
    public partial class JOURNEY
    {
        public decimal JOURNEY_ID { get; set; }
        public decimal ROUTE_ID { get; set; }
        public System.DateTime BEGIN_TIME { get; set; }
        public System.DateTime ARRIVAL_TIME { get; set; }
        public Nullable<decimal> TIME_DELAY { get; set; }
        public string DELAY_REASON { get; set; }
        public string CANCELLED_REASON { get; set; }
        public decimal BASE_PRICE { get; set; }
        public Nullable<decimal> NUM_OF_CARRIAGES { get; set; }
    }
}
