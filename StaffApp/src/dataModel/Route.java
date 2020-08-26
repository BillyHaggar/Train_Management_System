/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dataModel;

/**
 *
 * @author mstanford
 */
public class Route {
    protected Double Route_ID;
    protected Double Station_ID;
    protected Double Stop_Number;

    public Double getRoute_ID() {
        return Route_ID;
    }

    public void setRoute_ID(Double Route_ID) {
        this.Route_ID = Route_ID;
    }

    public Double getStation_ID() {
        return Station_ID;
    }

    public void setStation_ID(Double Station_ID) {
        this.Station_ID = Station_ID;
    }

    public Double getStop_Number() {
        return Stop_Number;
    }

    public void setStop_Number(Double Stop_Number) {
        this.Stop_Number = Stop_Number;
    }
   
}
