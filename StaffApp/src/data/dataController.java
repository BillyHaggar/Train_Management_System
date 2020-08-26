/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package data;


import dataModel.Job;
import dataModel.Journey;
import dataModel.Route;
import dataModel.Route_Num;
import dataModel.Station;
import dataModel.User_Account;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;
import java.nio.charset.StandardCharsets;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Base64;
import static java.util.Date.parse;
import java.util.List;
import java.util.Locale;
import java.util.Scanner;
import java.util.Set;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JOptionPane;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;
import org.json.simple.parser.ParseException;
/**
 *
 * @author mstanford
 */
public class dataController {
DateFormat simpleDateFormat=new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss", Locale.UK);
List <Journey> journeyList = new ArrayList<Journey>();
List <Route> routeList = new ArrayList<Route>();
List <Job> jobList = new ArrayList<Job>();
List <Station> stationList = new ArrayList<Station>();

User_Account currentUser;
Journey selectedJourney;
Route selectedRoute;
Job selectedJob;
Station selectedStation;
Route_Num selectedRoute_Num;

    public Journey getSelectedJourney() {
        return selectedJourney;
    }

    public void setSelectedJourney(Journey selectedJourney) {
        this.selectedJourney = selectedJourney;
    }

    public User_Account getCurrentUser() {
        return currentUser;
    }

    public void setCurrentUser(User_Account currentUser) {
        this.currentUser = currentUser;
    }


public void getAPIData() {
    
    JSONParser parser = new JSONParser();
    try {

            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/JOURNEY");//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET");
            conn.setRequestProperty("Accept", "application/json");
            if (conn.getResponseCode() != 200) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
            InputStreamReader in = new InputStreamReader(conn.getInputStream());
            BufferedReader br = new BufferedReader(in);
            JSONArray userArray = new JSONArray();
            userArray = (JSONArray) parser.parse(br.readLine());
            DateFormat simpleDateFormat=new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss", Locale.UK);
            for (int x = 0; x < userArray.size(); x++) {
                
                JSONObject current = (JSONObject) userArray.get(x);
                Journey journey = new Journey();
                journey.setArrival_Time( simpleDateFormat.parse((String) current.get("ARRIVAL_TIME")));
                journey.setBase_Price( (Double) current.get("BASE_PRICE"));
                journey.setBegin_Time( simpleDateFormat.parse((String) current.get("BEGIN_TIME")));
                journey.setCancelled_Reason((String) current.get("CANCELLED_REASON"));
                journey.setDelay_Reason((String) current.get("DELAY_REASON"));
                journey.setJourney_ID((Double) current.get("JOURNEY_ID"));
                journey.setNum_Of_Carriages((Double) current.get("NUM_OF_CARRIAGES"));
                journey.setRoute_ID((Double) current.get("ROUTE_ID"));
                journey.setTime_Delay((Double) current.get("TIME_DELAY"));
                journeyList.add(journey);
           }
            conn.disconnect();
         
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
        }
    
     try {

            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/ROUTE");//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET");
            conn.setRequestProperty("Accept", "application/json");
            if (conn.getResponseCode() != 200) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
            InputStreamReader in = new InputStreamReader(conn.getInputStream());
            BufferedReader br = new BufferedReader(in);
            JSONArray userArray = new JSONArray();
            userArray = (JSONArray) parser.parse(br.readLine());
            DateFormat simpleDateFormat=new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss", Locale.UK);
            for (int x = 0; x < userArray.size(); x++) {
                
                JSONObject current = (JSONObject) userArray.get(x);
                Route route = new Route();

                route.setStop_Number((Double) current.get("STOP_NUMBER"));
                route.setStation_ID((Double) current.get("STATION_ID"));
                route.setRoute_ID((Double) current.get("ROUTE_ID"));
                
                routeList.add(route);
           }
            conn.disconnect();
         
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
        }
      try {

            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/JOB");//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET");
            conn.setRequestProperty("Accept", "application/json");
            if (conn.getResponseCode() != 200) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
            InputStreamReader in = new InputStreamReader(conn.getInputStream());
            BufferedReader br = new BufferedReader(in);
            JSONArray userArray = new JSONArray();
            userArray = (JSONArray) parser.parse(br.readLine());
            DateFormat simpleDateFormat=new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss", Locale.UK);
            for (int x = 0; x < userArray.size(); x++) {
                
                JSONObject current = (JSONObject) userArray.get(x);
                Job job = new Job();

                job.setJob_ID((Double) current.get("JOB_ID"));
                job.setJourney_ID((Double) current.get("JOURNEY_ID"));
                job.setUser_ID((Double) current.get("USER_ID"));
                job.setJob_Date( simpleDateFormat.parse((String) current.get("JOB_DATE")));
                job.setJob_Description( (String) current.get("JOB_DESCRIPTION"));
                jobList.add(job);
           }
            conn.disconnect();
         
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
        }
       try {

            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/STATION");//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET");
            conn.setRequestProperty("Accept", "application/json");
            if (conn.getResponseCode() != 200) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
            InputStreamReader in = new InputStreamReader(conn.getInputStream());
            BufferedReader br = new BufferedReader(in);
            JSONArray userArray = new JSONArray();
            userArray = (JSONArray) parser.parse(br.readLine());
            DateFormat simpleDateFormat=new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss", Locale.UK);
            for (int x = 0; x < userArray.size(); x++) {
                
                JSONObject current = (JSONObject) userArray.get(x);
                Station station = new Station();
                station.setS_Address_Line_1((String) current.get("S_ADDRESS_LINE_1"));
                station.setS_Address_Line_2((String) current.get("S_ADDRESS_LINE_2"));
                station.setS_Postcode((String) current.get("S_POSTCODE"));
                station.setStation_Name((String) current.get("STATION_NAME"));
                station.setStation_Type((String) current.get("STATION_TYPE"));              
                station.setStation_ID((Double) current.get("STATION_ID"));
                stationList.add(station);
           }
            conn.disconnect();
         
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
        } 
}
public List<Journey> getJourneys() {
return journeyList;
}
public List<Route> getRoutes() {
return routeList;
}
public List<Job> getJobs() {
return jobList;
}
public List<Station> getStations() {
return stationList;
}

    public Route getSelectedRoute() {
        return selectedRoute;
    }

    public Route_Num getSelectedRoute_Num() {
        return selectedRoute_Num;
    }


//code added to get login functional, stans code left as is above to not confuse
//any of his logic
public boolean LoginAccount(String username, String password){
    User_Account tempUser = new User_Account();
    JSONParser parser = new JSONParser();
    String str = ""; 
   
    
    try {
            int ID = Integer.parseInt (username.replaceFirst("^.*\\D",""));
            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/USER_ACCOUNT/" + Integer.toString(ID))  ;//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET");
            conn.setRequestProperty("Accept", "application/json");
            if (conn.getResponseCode() != 200) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
            
           Scanner sc = new Scanner(url.openStream());
           while(sc.hasNext()){
               str += sc.nextLine();
           }
                JSONObject obj = (JSONObject)parser.parse(str);
           
                tempUser.setAlternative_Number( (String) obj.get("ALTERNATIVE_NUMBER"));
                tempUser.setContact_Number( (String) obj.get("CONTACT_NUMBER"));
                tempUser.setDate_Of_Birth( simpleDateFormat.parse((String) obj.get("DATE_OF_BIRTH")));
                tempUser.setEmail( (String) obj.get("EMAIL"));
                tempUser.setFirst_Name( (String) obj.get("FIRST_NAME"));
                tempUser.setLast_Name( (String) obj.get("LAST_NAME"));
                tempUser.setMarketing_Opt_In( (String) obj.get("MARKETING_OPT_IN"));
                tempUser.setU_Address_Line_1( (String) obj.get("U_ADDRESS_LINE_1"));
                tempUser.setU_Address_Line_2( (String) obj.get("U_ADDRESS_LINE_2"));
                tempUser.setU_Postcode( (String) obj.get("U_POSTCODE"));
                tempUser.setU_Town( (String) obj.get("U_TOWN"));
                tempUser.setUser_ID( (Double) obj.get("USER_ID"));
                tempUser.setUser_Password( (String) obj.get("USER_PASSWORD"));
                tempUser.setUser_Rank( (String) obj.get("USER_RANK"));
                tempUser.setUser_Name( (String) obj.get("USERNAME"));
           conn.disconnect();
           
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
            JOptionPane.showMessageDialog(null, "Invalid Username or Password");
        } 
    
        if(tempUser.getUser_Name().equals(username) && tempUser.getUser_Password().equals(password)){
    
          if(tempUser.getUser_Rank().equals("DRIVER") || tempUser.getUser_Rank().equals("STATION STAFF")){
           System.out.println("Logged in");
           currentUser = tempUser;
           return true;
           
           }else{
           JOptionPane.showMessageDialog(null, "YOUR ACCOUNT IS NOT RANKED TO USE THIS APP");
           return false;
          }
          }else{
            JOptionPane.showMessageDialog(null, "Invalid Username or Password");
            return false;
        }
}

public void findJourney(String journeyID){
    Journey tempjourney = new Journey();
    JSONParser parser = new JSONParser();
    String str = ""; 
    try {
            int ID = Integer.parseInt (journeyID.replaceFirst("^.*\\D",""));
            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/journey/" + Integer.toString(ID))  ;//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET");
            conn.setRequestProperty("Accept", "application/json");
            
            if (conn.getResponseCode() != 200) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
            
           Scanner sc = new Scanner(url.openStream());
           while(sc.hasNext()){
               str += sc.nextLine();
           }
                JSONObject obj = (JSONObject)parser.parse(str);
           
                tempjourney.setArrival_Time( simpleDateFormat.parse((String) obj.get("ARRIVAL_TIME")));
                tempjourney.setBase_Price( (Double) obj.get("BASE_PRICE"));
                tempjourney.setBegin_Time( simpleDateFormat.parse((String) obj.get("BEGIN_TIME")));
                tempjourney.setCancelled_Reason((String) obj.get("CANCELLED_REASON"));
                tempjourney.setDelay_Reason((String) obj.get("DELAY_REASON"));
                tempjourney.setJourney_ID((Double) obj.get("JOURNEY_ID"));
                tempjourney.setNum_Of_Carriages((Double) obj.get("NUM_OF_CARRIAGES"));
                tempjourney.setRoute_ID((Double) obj.get("ROUTE_ID"));
                tempjourney.setTime_Delay((Double) obj.get("TIME_DELAY"));
           conn.disconnect();
           
           selectedJourney = tempjourney;
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
            JOptionPane.showMessageDialog(null, "Invalid journey ID");
            
        } 
    }

public void FindRoute_Num(int Route_ID) {
    Route_Num tempRoute_Num = new Route_Num();
    JSONParser parser = new JSONParser();
    String str = ""; 
    try {
            int ID = Route_ID;
            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/Route_Num/" + Integer.toString(ID))  ;//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET");
            conn.setRequestProperty("Accept", "application/json");
            if (conn.getResponseCode() != 200) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
            
           Scanner sc = new Scanner(url.openStream());
           while(sc.hasNext()){
               str += sc.nextLine();
           }
                JSONObject obj = (JSONObject)parser.parse(str);
                tempRoute_Num.setRoute_ID((Double) obj.get("ROUTE_ID"));
                tempRoute_Num.setRoute_Name((String)obj.get("ROUTE_NAME"));
           conn.disconnect();
           
           selectedRoute_Num = tempRoute_Num;
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
            JOptionPane.showMessageDialog(null, "Cant Find Route"); 
        } 
}

public void GenRouteTable(){
   JSONParser parser = new JSONParser();
   try {

            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/ROUTE");//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET");
            conn.setRequestProperty("Accept", "application/json");
            if (conn.getResponseCode() != 200) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
            InputStreamReader in = new InputStreamReader(conn.getInputStream());
            BufferedReader br = new BufferedReader(in);
            JSONArray userArray = new JSONArray();
            userArray = (JSONArray) parser.parse(br.readLine());
            DateFormat simpleDateFormat=new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss", Locale.UK);
            for (int x = 0; x < userArray.size(); x++) {
                
                JSONObject current = (JSONObject) userArray.get(x);
                Route route = new Route();

                route.setStop_Number((Double) current.get("STOP_NUMBER"));
                route.setStation_ID((Double) current.get("STATION_ID"));
                route.setRoute_ID((Double) current.get("ROUTE_ID"));
                
                routeList.add(route);
           }
            conn.disconnect();
         
            System.out.println("COMPLETE DOWNLOAD");
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
        }
   
}
    
public String FindStopNames(int Route_ID){
    JSONParser parser = new JSONParser();
    int station_ID;
    String str = "";
    String stops = "";
    
    for(int i = 0; i < routeList.size(); i++){
        
      if (routeList.get(i).getRoute_ID() == (double)Route_ID){
          try {
              station_ID = ((int) Math.floor(routeList.get(i).getStation_ID()));
              URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/Station/" + Integer.toString(station_ID))  ;//your url i.e fetch data from .
              HttpURLConnection conn = (HttpURLConnection) url.openConnection();
              conn.setRequestMethod("GET");
              conn.setRequestProperty("Accept", "application/json");
              if (conn.getResponseCode() != 200) {
                  throw new RuntimeException("Failed : HTTP Error code : "
                          + conn.getResponseCode());
              }
              
              Scanner sc = new Scanner(url.openStream());
              str = "";
              while(sc.hasNext()){
                  str += sc.nextLine();
              }
              JSONObject obj = (JSONObject)parser.parse(str);
              stops = stops + obj.get("STATION_NAME") + ", ";
              conn.disconnect();
              
            } catch (Exception e) {
              System.out.println("Exception in NetClientGet:- " + e);
              JOptionPane.showMessageDialog(null, "Cant find station name");
            }
        }  
    }
    return stops;
}

public void GetAllJourneys(){
    JSONParser parser = new JSONParser();
    DateTimeFormatter dateFormat = DateTimeFormatter.ofPattern("yyyy-MM-dd'T'HH:mm:ss");
    LocalDateTime now = LocalDateTime.now();
   journeyList.clear();
   try {

            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/journey");//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET");
            conn.setRequestProperty("Accept", "application/json");
            if (conn.getResponseCode() != 200) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
            InputStreamReader in = new InputStreamReader(conn.getInputStream());
            BufferedReader br = new BufferedReader(in);
            JSONArray userArray = new JSONArray();
            userArray = (JSONArray) parser.parse(br.readLine());
            DateFormat simpleDateFormat=new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss", Locale.UK);
            
            for (int x = 0; x < userArray.size(); x++) {
                
                JSONObject obj = (JSONObject) userArray.get(x);
                Journey tempjourney = new Journey();

                tempjourney.setArrival_Time( simpleDateFormat.parse((String) obj.get("ARRIVAL_TIME")));
                tempjourney.setBase_Price( (Double) obj.get("BASE_PRICE"));
                tempjourney.setBegin_Time( simpleDateFormat.parse((String) obj.get("BEGIN_TIME")));
                tempjourney.setCancelled_Reason((String) obj.get("CANCELLED_REASON"));
                tempjourney.setDelay_Reason((String) obj.get("DELAY_REASON"));
                tempjourney.setJourney_ID((Double) obj.get("JOURNEY_ID"));
                tempjourney.setNum_Of_Carriages((Double) obj.get("NUM_OF_CARRIAGES"));
                tempjourney.setRoute_ID((Double) obj.get("ROUTE_ID"));
                tempjourney.setTime_Delay((Double) obj.get("TIME_DELAY"));
                
                
               if(tempjourney.getBegin_Time().compareTo(simpleDateFormat.parse(dateFormat.format(now))) >= 0){
               journeyList.add(tempjourney);
               }
                
           }
            conn.disconnect();
         
            System.out.println("COMPLETE DOWNLOAD");
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
        }
}

public void GetUsersJobs(){
    JSONParser parser = new JSONParser();
    DateFormat simpleDateFormat=new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss", Locale.UK);
    jobList.clear();
    try {
            
            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/job");//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET");
            conn.setRequestProperty("Accept", "application/json");
            if (conn.getResponseCode() != 200) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
            InputStreamReader in = new InputStreamReader(conn.getInputStream());
            BufferedReader br = new BufferedReader(in);
            JSONArray userArray = new JSONArray();
            userArray = (JSONArray) parser.parse(br.readLine());
            for (int x = 0; x < userArray.size(); x++) {
                
                Job tempJob = new Job();
                JSONObject obj = (JSONObject) userArray.get(x);
                
                tempJob.setJob_ID((Double) obj.get("JOB_ID"));
                tempJob.setJourney_ID((Double) obj.get("JOURNEY_ID"));
                tempJob.setUser_ID((Double) obj.get("USER_ID"));
                tempJob.setJob_Date(simpleDateFormat.parse((String) obj.get("JOB_DATE")));
                tempJob.setJob_Description( (String) obj.get("JOB_DESCRIPTION"));
                

                if (tempJob.getUser_ID().equals(currentUser.getUser_ID()) && !(tempJob.getJob_Description().equals("COMPLETE")))
                jobList.add(tempJob);
                
            }
           conn.disconnect();
           
           
           
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
            JOptionPane.showMessageDialog(null, "unable to get users jobs");
            
        } 
    }

public void FindJob(int Job_Id){
   for (int m = 0; m < jobList.size(); m++){
       double i = Job_Id;
       
       if(!(jobList.get(m).getJob_Description().equals("COMPLETE"))){
        if ((jobList.get(m).getJob_ID()).equals(i)){
               selectedJob = jobList.get(m);
        }else{
               selectedJob = null;
        }
       }else{
          JOptionPane.showMessageDialog(null, "Job already set as complete"); 
       }
       
   }
}

public void PutJobComplete(int Job_Id){
    JSONParser parser = new JSONParser();
    DateFormat simpleDateFormat=new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss", Locale.UK);
    try {
        FindJob(Job_Id);
        String str = simpleDateFormat.format(selectedJob.getJob_Date());

 
        
        
        //any null able feates need to be checked in order to allow josn oblect to be formatted correctly
        String user_ID;
        if (selectedJob.getUser_ID() == null){
            user_ID = "null";
        } else {
            user_ID = Integer.toString(((int)Math.round(selectedJob.getUser_ID())));
        }
        String journey_ID;
        if (selectedJob.getJourney_ID() == null){
            journey_ID = "null";
        } else {
            journey_ID = Integer.toString(((int)Math.round(selectedJob.getJourney_ID())));
        }
        String job_description;
        if (selectedJob.getJob_Description() == null){
            job_description = "null";
        } else {
            job_description = "\"COMPLETE\"";
        }
        
        
        final String Post_Data = "{" +
                                       "\"JOB_ID\": " + Job_Id +"," +
                                       "\"USER_ID\": " + user_ID +  "," +
                                       "\"JOB_DESCRIPTION\": "+ job_description +  "," +
                                       "\"JOURNEY_ID\": " + journey_ID +  "," +
                                       "\"JOB_DATE\": \"" + str +  "\"" +
                                       "}";
            
        
            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/job/" + (int)Math.round(selectedJob.getJob_ID()));//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("PUT");
            conn.setDoOutput(true);
            conn.setRequestProperty("Content-Type", "application/json");
            conn.setRequestProperty("Accept", "application/json");
            OutputStream os = conn.getOutputStream();
            os.write(Post_Data.getBytes());
            os.flush();
            os.close();
            
            if (conn.getResponseCode() != 202) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
           conn.disconnect();
           
           
           
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
            JOptionPane.showMessageDialog(null, "unable to set job as Complete");
            
        } 
}

public boolean PutNewPassword(String oldPassword, String newPassword, String confirmPassword){
    JSONParser parser = new JSONParser();
    DateFormat simpleDateFormat=new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss", Locale.UK);
    String str = simpleDateFormat.format(currentUser.getDate_Of_Birth());
    
    if (!(oldPassword.equals(currentUser.getUser_Password()))){
        JOptionPane.showMessageDialog(null, "OLD PASSWORD DOESN\'T MATCH");
        throw new RuntimeException("OLD PASSWORD DOESN\'T MATCH");
    }else{
     
    if (!(newPassword.equals(confirmPassword))){
        JOptionPane.showMessageDialog(null, "NEW PASSWORDS NEED TO MATCH");
        throw new RuntimeException("NEW PASSWORDS NEED TO MATCH");
    }else{
        
    if (newPassword.equals(oldPassword)){
        JOptionPane.showMessageDialog(null, "NEW PASSWORD CANNOT BE THE SAME AS OLD ");
        throw new RuntimeException("NEW PASSWORD CANNOT BE THE SAME AS OLD ");
    }else{
    
//any null able feates need to be checked in order to allow josn oblect to be formatted correctly
    String U_Address_Line_2;
        if (currentUser.getU_Address_Line_2() == null){
            U_Address_Line_2 = "null";
        } else {
            U_Address_Line_2 = "\""+ currentUser.getU_Address_Line_2() +"\"";
        }
        
    String U_Town;
        if (currentUser.getU_Town() == null){
            U_Town = "null";
        } else {
            U_Town = "\""+ currentUser.getU_Town() +"\"";
        }
        
    String Alternative_Number;
        if (currentUser.getAlternative_Number() == null){
            Alternative_Number = "null";
        } else {
            Alternative_Number = "\""+ currentUser.getAlternative_Number() +"\"";
        }
        
    String Contact_Number;
        if (currentUser.getContact_Number() == null){
            Contact_Number = "null";
        } else {
            Contact_Number = "\""+ currentUser.getContact_Number() +"\"";
        }
    
    try {
        final String Post_Data = "{" +
                                    "\"USER_ID\": " + ((int)Math.round(currentUser.getUser_ID())) +"," +
                                    "\"USERNAME\": \"" + currentUser.getUser_Name() + "\"," +
                                    "\"USER_PASSWORD\": \"" + newPassword + "\"," +
                                    "\"USER_RANK\": \"" + currentUser.getUser_Rank() + "\"," +
                                    "\"FIRST_NAME\": \"" + currentUser.getFirst_Name() + "\"," +
                                    "\"LAST_NAME\": \"" + currentUser.getLast_Name() + "\"," +
                                    "\"DATE_OF_BIRTH\": \"" + str +  "\"," +
                                    "\"U_ADDRESS_LINE_1\": \"" + currentUser.getU_Address_Line_1() + "\"," +
                                    "\"U_ADDRESS_LINE_2\": " + U_Address_Line_2 + "," +
                                    "\"U_POSTCODE\": \"" + currentUser.getU_Postcode() + "\"," +
                                    "\"U_TOWN\": " + U_Town + "," +
                                    "\"EMAIL\": \"" + currentUser.getEmail() + "\"," +
                                    "\"CONTACT_NUMBER\": " + Contact_Number + "," +
                                    "\"ALTERNATIVE_NUMBER\": " + Alternative_Number + "," +
                                    "\"MARKETING_OPT_IN\": \"" + currentUser.getMarketing_Opt_In() + "\"" +
                                    "}" ;
            
        System.out.println(Post_Data);
            URL url = new URL("http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/user_account/" + (int)Math.round(currentUser.getUser_ID()));//your url i.e fetch data from .
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("PUT");
            conn.setDoOutput(true);
            conn.setRequestProperty("Content-Type", "application/json");
            conn.setRequestProperty("Accept", "application/json");
            OutputStream os = conn.getOutputStream();
            os.write(Post_Data.getBytes());
            os.flush();
            os.close();
        
            if (conn.getResponseCode() != 202) {
                throw new RuntimeException("Failed : HTTP Error code : "
                        + conn.getResponseCode());
            }
            
           conn.disconnect();
           JOptionPane.showMessageDialog(null, "PASSWORD CHANGED");
           currentUser.setUser_Password(newPassword);
           return true;
            
        } catch (Exception e) {
            System.out.println("Exception in NetClientGet:- " + e);
            JOptionPane.showMessageDialog(null, "Cannot change Password, REMEMBER MUST BE A MINIMUM OF 6 CHARACTERS AND INCLUDE A SYMBOL(!@£$%^&*()_+=-) ");
            return false;
        }
    }
    }
    }
}

public String SQLInjectionCheck(String string){
    if (string.contains("\'")){
        System.out.println("SQL INJECTION DETECTED");
        JOptionPane.showMessageDialog(null, "SQL INJECTION DETECTED");
        throw new RuntimeException("SQL INJECTION DETECTED");
    }
    
    return string;
}

 public String HashString (String inputString) throws NoSuchAlgorithmException {
        MessageDigest digest = MessageDigest.getInstance("SHA-256");
        byte[] hash = digest.digest(inputString.getBytes(StandardCharsets.UTF_8));
        return Base64.getEncoder().encodeToString(hash);
    
}

}


