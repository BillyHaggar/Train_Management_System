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
public class Station {
    protected Double Station_ID;
    protected String Station_Type;
    protected String Station_Name;
    protected String S_Address_Line_1;
    protected String S_Address_Line_2;
    protected String S_Postcode;

    public Double getStation_ID() {
        return Station_ID;
    }

    public void setStation_ID(Double Station_ID) {
        this.Station_ID = Station_ID;
    }

    public String getStation_Type() {
        return Station_Type;
    }

    public void setStation_Type(String Station_Type) {
        this.Station_Type = Station_Type;
    }

    public String getStation_Name() {
        return Station_Name;
    }

    public void setStation_Name(String Station_Name) {
        this.Station_Name = Station_Name;
    }

    public String getS_Address_Line_1() {
        return S_Address_Line_1;
    }

    public void setS_Address_Line_1(String S_Address_Line_1) {
        this.S_Address_Line_1 = S_Address_Line_1;
    }

    public String getS_Address_Line_2() {
        return S_Address_Line_2;
    }

    public void setS_Address_Line_2(String S_Address_Line_2) {
        this.S_Address_Line_2 = S_Address_Line_2;
    }

    public String getS_Postcode() {
        return S_Postcode;
    }

    public void setS_Postcode(String S_Postcode) {
        this.S_Postcode = S_Postcode;
    }

}
