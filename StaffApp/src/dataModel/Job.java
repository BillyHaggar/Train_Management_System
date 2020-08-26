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
public class Job {
    protected Date Job_Date;
    protected String Job_Description;
    protected Double Job_ID;
    protected Double Journey_ID;
    protected Double User_ID;

    public Date getJob_Date() {
        return Job_Date;
    }

    public void setJob_Date(Date Job_Date) {
        this.Job_Date = Job_Date;
    }

    public String getJob_Description() {
        return Job_Description;
    }

    public void setJob_Description(String Job_Description) {
        this.Job_Description = Job_Description;
    }

    public Double getJob_ID() {
        return Job_ID;
    }

    public void setJob_ID(Double Job_ID) {
        this.Job_ID = Job_ID;
    }

    public Double getJourney_ID() {
        return Journey_ID;
    }

    public void setJourney_ID(Double Journey_ID) {
        this.Journey_ID = Journey_ID;
    }

    public Double getUser_ID() {
        return User_ID;
    }

    public void setUser_ID(Double User_ID) {
        this.User_ID = User_ID;
    }
    
    
}
