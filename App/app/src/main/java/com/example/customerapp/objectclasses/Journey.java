package com.example.customerapp.objectclasses;

import android.os.Parcel;
import android.os.Parcelable;

import java.util.Date;

public class Journey implements Parcelable {

    private Double JourneyID;
    private Double RouteID;
    private Date BeginTime;
    private Date ArrivalTime;
    private Double TimeDelay;
    private String DelayReason;
    private String CancelledReason;
    private Double BasePrice;
    private Double NumOfCarriages;

    public Double getJourneyID() {
        return JourneyID;
    }

    public Double getRouteID() {
        return RouteID;
    }

    public Date getBeginTime() {
        return BeginTime;
    }

    public Date getArrivalTime() {
        return ArrivalTime;
    }

    public Double getTimeDelay() {
        return TimeDelay;
    }

    public String getDelayReason() {
        return DelayReason;
    }

    public String getCancelledReason() {
        return CancelledReason;
    }

    public Double getBasePrice() { return BasePrice; }

    public Double getNumOfCarriages() {
        return NumOfCarriages;
    }

    @Override
    public int describeContents() {
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags) {
        dest.writeValue(this.JourneyID);
        dest.writeValue(this.RouteID);
        dest.writeLong(this.BeginTime != null ? this.BeginTime.getTime() : -1);
        dest.writeLong(this.ArrivalTime != null ? this.ArrivalTime.getTime() : -1);
        dest.writeValue(this.TimeDelay);
        dest.writeString(this.DelayReason);
        dest.writeString(this.CancelledReason);
        dest.writeValue(this.BasePrice);
        dest.writeValue(this.NumOfCarriages);
    }

    public Journey() {
    }

    protected Journey(Parcel in) {
        this.JourneyID = (Double) in.readValue(Double.class.getClassLoader());
        this.RouteID = (Double) in.readValue(Double.class.getClassLoader());
        long tmpBeginTime = in.readLong();
        this.BeginTime = tmpBeginTime == -1 ? null : new Date(tmpBeginTime);
        long tmpArrivalTime = in.readLong();
        this.ArrivalTime = tmpArrivalTime == -1 ? null : new Date(tmpArrivalTime);
        this.TimeDelay = (Double) in.readValue(Double.class.getClassLoader());
        this.DelayReason = in.readString();
        this.CancelledReason = in.readString();
        this.BasePrice = (Double) in.readValue(Double.class.getClassLoader());
        this.NumOfCarriages = (Double) in.readValue(Double.class.getClassLoader());
    }

    public static final Parcelable.Creator<Journey> CREATOR = new Parcelable.Creator<Journey>() {
        @Override
        public Journey createFromParcel(Parcel source) {
            return new Journey(source);
        }

        @Override
        public Journey[] newArray(int size) {
            return new Journey[size];
        }
    };
}
