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
public class Vehicle {
    protected String Vehicle_Reg;
    protected Integer Journey_ID;
    protected Integer P_Capacity;
    protected String Stored_Location;
    protected String Vehicle_Type;

    public String getVehicle_Reg() {
        return Vehicle_Reg;
    }

    public void setVehicle_Reg(String Vehicle_Reg) {
        this.Vehicle_Reg = Vehicle_Reg;
    }

    public Integer getJourney_ID() {
        return Journey_ID;
    }

    public void setJourney_ID(Integer Journey_ID) {
        this.Journey_ID = Journey_ID;
    }

    public Integer getP_Capacity() {
        return P_Capacity;
    }

    public void setP_Capacity(Integer P_Capacity) {
        this.P_Capacity = P_Capacity;
    }

    public String getStored_Location() {
        return Stored_Location;
    }

    public void setStored_Location(String Stored_Location) {
        this.Stored_Location = Stored_Location;
    }

    public String getVehicle_Type() {
        return Vehicle_Type;
    }

    public void setVehicle_Type(String Vehicle_Type) {
        this.Vehicle_Type = Vehicle_Type;
    }
 
}
