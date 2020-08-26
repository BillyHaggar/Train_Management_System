/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dataModel;

import java.util.Date;

/**
 *
 * @author mstanford
 */
public class Journey {
    protected Double Journey_ID;
    protected Double Route_ID;
    protected Date Begin_Time;
    protected Date Arrival_Time;
    protected Double Time_Delay;
    protected String Delay_Reason;
    protected String Cancelled_Reason;
    protected Double Base_Price;
    protected Double Num_Of_Carriages;

    public Double getJourney_ID() {
        return Journey_ID;
    }

    public void setJourney_ID(Double Journey_ID) {
        this.Journey_ID = Journey_ID;
    }

    public Double getRoute_ID() {
        return Route_ID;
    }

    public void setRoute_ID(Double Route_ID) {
        this.Route_ID = Route_ID;
    }

    public Date getBegin_Time() {
        return Begin_Time;
    }

    public void setBegin_Time(Date Begin_Time) {
        this.Begin_Time = Begin_Time;
    }

    public Date getArrival_Time() {
        return Arrival_Time;
    }

    public void setArrival_Time(Date Arrival_Time) {
        this.Arrival_Time = Arrival_Time;
    }

    public Double getTime_Delay() {
        return Time_Delay;
    }

    public void setTime_Delay(Double Time_Delay) {
        this.Time_Delay = Time_Delay;
    }

    public String getDelay_Reason() {
        return Delay_Reason;
    }

    public void setDelay_Reason(String Delay_Reason) {
        this.Delay_Reason = Delay_Reason;
    }

    public String getCancelled_Reason() {
        return Cancelled_Reason;
    }

    public void setCancelled_Reason(String Cancelled_Reason) {
        this.Cancelled_Reason = Cancelled_Reason;
    }

    public Double getBase_Price() {
        return Base_Price;
    }

    public void setBase_Price(Double Base_Price) {
        this.Base_Price = Base_Price;
    }

    public Double getNum_Of_Carriages() {
        return Num_Of_Carriages;
    }

    public void setNum_Of_Carriages(Double Num_Of_Carriages) {
        this.Num_Of_Carriages = Num_Of_Carriages;
    }
    
}
