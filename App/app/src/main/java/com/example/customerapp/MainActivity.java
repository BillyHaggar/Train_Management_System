package com.example.customerapp;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.net.Uri;
import android.support.v4.content.LocalBroadcastManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import com.example.customerapp.objectclasses.Journey;
import com.example.customerapp.services.BackgroundService;



public class MainActivity extends AppCompatActivity {

    private static final String URL = "http://web.socem.plymouth.ac.uk/IntProj/PRCS252A/api/journey";
    private BroadcastReceiver broadcastReceiver = new BroadcastReceiver() {
        @Override
        public void onReceive(Context context, Intent intent) {
            Journey[] journeys = (Journey[]) intent.getParcelableArrayExtra(BackgroundService.servicePayload);
        }
    };


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Intent intent = new Intent(this, BackgroundService.class);
        intent.setData(Uri.parse(URL));
        startService(intent);

        LocalBroadcastManager.getInstance(getApplicationContext()).registerReceiver(broadcastReceiver, new IntentFilter(BackgroundService.serviceMessage));

    }

    @Override
    protected void onDestroy(){
        super.onDestroy();
        LocalBroadcastManager.getInstance(getApplicationContext()).unregisterReceiver(broadcastReceiver);
    }


}
