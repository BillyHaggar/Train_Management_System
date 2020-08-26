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
public class Booking {
    protected Integer Booking_ID;
    protected Integer Journey_ID;
    protected Integer User_ID;
    protected Integer Booking_Code;

    public Integer getBooking_ID() {
        return Booking_ID;
    }

    public void setBooking_ID(Integer Booking_ID) {
        this.Booking_ID = Booking_ID;
    }

    public Integer getJourney_ID() {
        return Journey_ID;
    }

    public void setJourney_ID(Integer Journey_ID) {
        this.Journey_ID = Journey_ID;
    }

    public Integer getUser_ID() {
        return User_ID;
    }

    public void setUser_ID(Integer User_ID) {
        this.User_ID = User_ID;
    }

    public Integer getBooking_Code() {
        return Booking_Code;
    }

    public void setBooking_Code(Integer Booking_Code) {
        this.Booking_Code = Booking_Code;
    }
    
}
