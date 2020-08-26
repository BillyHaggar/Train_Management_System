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
public class User_Account {
    protected Double User_ID;
    protected String User_Password;
    protected String User_Rank;
    protected String First_Name;
    protected String Last_Name;
    protected Date Date_Of_Birth;
    protected String U_Address_Line_1;
    protected String U_Address_Line_2;
    protected String U_Postcode;
    protected String U_Town;
    protected String Email;
    protected String Contact_Number;
    protected String Alternative_Number;
    protected String Marketing_Opt_In;
    protected String User_Name;

    public String getUser_Name() {
        return User_Name;
    }

    public void setUser_Name(String User_Name) {
        this.User_Name = User_Name;
    }

    public Double getUser_ID() {
        return User_ID;
    }

    public void setUser_ID(Double User_ID) {
        this.User_ID = User_ID;
    }

    public String getUser_Password() {
        return User_Password;
    }

    public void setUser_Password(String User_Password) {
        this.User_Password = User_Password;
    }

    public String getUser_Rank() {
        return User_Rank;
    }

    public void setUser_Rank(String User_Rank) {
        this.User_Rank = User_Rank;
    }

    public String getFirst_Name() {
        return First_Name;
    }

    public void setFirst_Name(String First_Name) {
        this.First_Name = First_Name;
    }

    public String getLast_Name() {
        return Last_Name;
    }

    public void setLast_Name(String Last_Name) {
        this.Last_Name = Last_Name;
    }

    public Date getDate_Of_Birth() {
        return Date_Of_Birth;
    }

    public void setDate_Of_Birth(Date Date_Of_Birth) {
        this.Date_Of_Birth = Date_Of_Birth;
    }

    public String getU_Address_Line_1() {
        return U_Address_Line_1;
    }

    public void setU_Address_Line_1(String U_Address_Line_1) {
        this.U_Address_Line_1 = U_Address_Line_1;
    }

    public String getU_Address_Line_2() {
        return U_Address_Line_2;
    }

    public void setU_Address_Line_2(String U_Address_Line_2) {
        this.U_Address_Line_2 = U_Address_Line_2;
    }

    public String getU_Postcode() {
        return U_Postcode;
    }

    public void setU_Postcode(String U_Postcode) {
        this.U_Postcode = U_Postcode;
    }

    public String getU_Town() {
        return U_Town;
    }

    public void setU_Town(String U_Town) {
        this.U_Town = U_Town;
    }

    public String getEmail() {
        return Email;
    }

    public void setEmail(String Email) {
        this.Email = Email;
    }

    public String getContact_Number() {
        return Contact_Number;
    }

    public void setContact_Number(String Contact_Number) {
        this.Contact_Number = Contact_Number;
    }

    public String getAlternative_Number() {
        return Alternative_Number;
    }

    public void setAlternative_Number(String Alternative_Number) {
        this.Alternative_Number = Alternative_Number;
    }

    public String getMarketing_Opt_In() {
        return Marketing_Opt_In;
    }

    public void setMarketing_Opt_In(String Marketing_Opt_In) {
        this.Marketing_Opt_In = Marketing_Opt_In;
    }
    
}
