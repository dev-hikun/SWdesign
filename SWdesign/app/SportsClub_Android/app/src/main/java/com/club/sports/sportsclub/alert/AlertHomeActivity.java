package com.club.sports.sportsclub.alert;

import android.app.TabActivity;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.TabHost;
import android.widget.TextView;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.tab.contests.TabContestManagementActivity;
import com.club.sports.sportsclub.tab.contests.TabFriendshipContestActivity;
import com.club.sports.sportsclub.tab.contests.TabPublicContestActivity;
import com.club.sports.sportsclub.tab.contests.TabTotalContestActivity;

/**
 * Created by again on 2017-09-23.
 */

public class AlertHomeActivity extends AppCompatActivity{

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sportsclub_alert);

        initialize();
    }

    private void initialize() {

    }

}
