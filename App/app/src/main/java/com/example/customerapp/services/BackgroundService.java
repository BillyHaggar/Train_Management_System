package com.example.customerapp.services;

import android.app.IntentService;
import android.content.Intent;
import android.net.Uri;
import android.support.v4.content.LocalBroadcastManager;
import android.util.Log;
import com.example.customerapp.datacontroller.GetAPIData;
import com.example.customerapp.objectclasses.Journey;
import com.google.gson.Gson;
import java.io.IOException;


public class BackgroundService extends IntentService {



    public static final String TAG = "BackgroundService";
    public static final String serviceMessage = "serviceMessage";
    public static final String servicePayload = "servicePayload";

    public BackgroundService() {
        super("BackgroundService");
    }

    @Override
    protected void onHandleIntent(Intent intent) {
        Uri uri = intent.getData();
        Log.i(TAG, "onHandleIntent: " + uri.toString());

        String response;
        try{
            response = GetAPIData.getAPIData(uri.toString());
        } catch (IOException e){
            e.printStackTrace();
            return;
        }

        Gson gson = new Gson();
        Journey[] journeys = gson.fromJson(response, Journey[].class);

        Intent messageIntent = new Intent(serviceMessage);
        messageIntent.putExtra(servicePayload, journeys);
        LocalBroadcastManager broadcastManager = LocalBroadcastManager.getInstance(getApplicationContext());
        broadcastManager.sendBroadcast(messageIntent);
    }

    @Override
    public void onCreate(){
        super.onCreate();
    }

    @Override
    public void onDestroy(){
        super.onDestroy();
    }


}
