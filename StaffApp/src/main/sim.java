/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package main;

import data.dataController;
import forms.Login;
/**
 *
 * @author mstanford
 */
public class sim {
    
     public static dataController controller;
     
     public static void main(String[] args) {
     controller = new dataController();
     controller.GenRouteTable();
     Login view = new Login();
     view.setVisible(true);
     }
     
     
}
