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
public class Transaction_Log {
    protected Integer Transaction_ID;
    protected String Card_Last_Digits;
    protected Date Time_Of_Transaction;
    protected Integer Transaction_Cost;

    public Integer getTransaction_ID() {
        return Transaction_ID;
    }

    public void setTransaction_ID(Integer Transaction_ID) {
        this.Transaction_ID = Transaction_ID;
    }

    public String getCard_Last_Digits() {
        return Card_Last_Digits;
    }

    public void setCard_Last_Digits(String Card_Last_Digits) {
        this.Card_Last_Digits = Card_Last_Digits;
    }

    public Date getTime_Of_Transaction() {
        return Time_Of_Transaction;
    }

    public void setTime_Of_Transaction(Date Time_Of_Transaction) {
        this.Time_Of_Transaction = Time_Of_Transaction;
    }

    public Integer getTransaction_Cost() {
        return Transaction_Cost;
    }

    public void setTransaction_Cost(Integer Transaction_Cost) {
        this.Transaction_Cost = Transaction_Cost;
    }

}
