package com.club.sports.sportsclub.main;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.Toast;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.home.SportsClubHomeActivity;

import java.util.Timer;
import java.util.TimerTask;

/**
 * Created by again on 2017-09-12.
 */

public class SportsClubMainActivity extends AppCompatActivity {

    private BackPressCloseHandler mBackPressCloseHandler;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sportsclub_main);

        initialize();
    }

    private void initialize(){
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        converseDisplay();
    }

    private void converseDisplay(){
        Timer timer = new Timer();
        timer.schedule(new TimerTask() {

            @Override
            public void run() {
                // TODO Auto-generated method stub

                Intent intent = new Intent(SportsClubMainActivity.this, SportsClubHomeActivity.class);
                intent.putExtra("login_info", "main_activity");
                startActivity(intent);
                finish();
            }
        }, 2000);
    }

    @Override
    public void onBackPressed(){
        mBackPressCloseHandler.onBackPressed();
    }
}
