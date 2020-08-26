package com.example.customerapp.objectclasses;
import android.os.Parcel;
import android.os.Parcelable;

import java.util.Date;

public class User implements Parcelable {

    private Double User_ID;
    private String Username;
    private String User_Password;
    private String User_Rank;
    private String First_Name;
    private String Last_Name;
    private Date Date_Of_Birth;
    private String U_Address_Line_1;
    private String U_Address_Line_2;
    private String U_Postcode;
    private String U_Town;
    private String Email;
    private String Contact_Number;
    private String Alternative_Number;
    private Boolean Marketing_Opt_In;

    public Double getUser_ID() {
        return User_ID;
    }

    public void setUser_ID(Double user_ID) {
        User_ID = user_ID;
    }

    public String getUsername() {
        return Username;
    }

    public void setUsername(String username) {
        Username = username;
    }

    public String getUser_Password() {
        return User_Password;
    }

    public void setUser_Password(String user_Password) {
        User_Password = user_Password;
    }

    public String getUser_Rank() {
        return User_Rank;
    }

    public void setUser_Rank(String user_Rank) {
        User_Rank = user_Rank;
    }

    public String getFirst_Name() {
        return First_Name;
    }

    public void setFirst_Name(String first_Name) {
        First_Name = first_Name;
    }

    public String getLast_Name() {
        return Last_Name;
    }

    public void setLast_Name(String last_Name) {
        Last_Name = last_Name;
    }

    public Date getDate_Of_Birth() {
        return Date_Of_Birth;
    }

    public void setDate_Of_Birth(Date date_Of_Birth) {
        Date_Of_Birth = date_Of_Birth;
    }

    public String getU_Address_Line_1() {
        return U_Address_Line_1;
    }

    public void setU_Address_Line_1(String u_Address_Line_1) {
        U_Address_Line_1 = u_Address_Line_1;
    }

    public String getU_Address_Line_2() {
        return U_Address_Line_2;
    }

    public void setU_Address_Line_2(String u_Address_Line_2) {
        U_Address_Line_2 = u_Address_Line_2;
    }

    public String getU_Postcode() {
        return U_Postcode;
    }

    public void setU_Postcode(String u_Postcode) {
        U_Postcode = u_Postcode;
    }

    public String getU_Town() {
        return U_Town;
    }

    public void setU_Town(String u_Town) {
        U_Town = u_Town;
    }

    public String getEmail() {
        return Email;
    }

    public void setEmail(String email) {
        Email = email;
    }

    public String getContact_Number() {
        return Contact_Number;
    }

    public void setContact_Number(String contact_Number) {
        Contact_Number = contact_Number;
    }

    public String getAlternative_Number() {
        return Alternative_Number;
    }

    public void setAlternative_Number(String alternative_Number) {
        Alternative_Number = alternative_Number;
    }

    public Boolean getMarketing_Opt_In() {
        return Marketing_Opt_In;
    }

    public void setMarketing_Opt_In(Boolean marketing_Opt_In) {
        Marketing_Opt_In = marketing_Opt_In;
    }


    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeValue(this.User_ID);
        dest.writeString(this.Username);
        dest.writeString(this.User_Password);
        dest.writeString(this.User_Rank);
        dest.writeString(this.First_Name);
        dest.writeString(this.Last_Name);
        dest.writeLong(this.Date_Of_Birth != null ? this.Date_Of_Birth.getTime() : -1);
        dest.writeString(this.U_Address_Line_1);
        dest.writeString(this.U_Address_Line_2);
        dest.writeString(this.U_Postcode);
        dest.writeString(this.U_Town);
        dest.writeString(this.Email);
        dest.writeString(this.Contact_Number);
        dest.writeString(this.Alternative_Number);
        dest.writeValue(this.Marketing_Opt_In);
    }

    public User() {
    }

    protected User(Parcel in) {
        this.User_ID = (Double) in.readValue(Double.class.getClassLoader());
        this.Username = in.readString();
        this.User_Password = in.readString();
        this.User_Rank = in.readString();
        this.First_Name = in.readString();
        this.Last_Name = in.readString();
        long tmpDate_Of_Birth = in.readLong();
        this.Date_Of_Birth = tmpDate_Of_Birth == -1 ? null : new Date(tmpDate_Of_Birth);
        this.U_Address_Line_1 = in.readString();
        this.U_Address_Line_2 = in.readString();
        this.U_Postcode = in.readString();
        this.U_Town = in.readString();
        this.Email = in.readString();
        this.Contact_Number = in.readString();
        this.Alternative_Number = in.readString();
        this.Marketing_Opt_In = (Boolean) in.readValue(Boolean.class.getClassLoader());
    }

    public static final Parcelable.Creator<User> CREATOR = new Parcelable.Creator<User>() {
        @Override
        public User createFromParcel(Parcel source) {
            return new User(source);
        }

        @Override
        public User[] newArray(int size) {
            return new User[size];
        }
    };
}
