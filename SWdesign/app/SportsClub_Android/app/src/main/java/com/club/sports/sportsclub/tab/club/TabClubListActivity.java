package com.club.sports.sportsclub.tab.club;

import android.app.TabActivity;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.widget.TabHost;
import android.widget.TextView;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.login.LoginActivity;
import com.club.sports.sportsclub.tab.TabContestInfoActivity;
import com.club.sports.sportsclub.tab.TabGroupActivity;
import com.club.sports.sportsclub.tab.TabMyInfoActivity;
import com.club.sports.sportsclub.tab.TabRankActivity;

/**
 * Created by again on 2017-09-12.
 */

public class TabClubListActivity extends AppCompatActivity {


    private BackPressCloseHandler mBackPressCloseHandler;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sprotsclub_list_index_1);

        initialize();
    }

    private void initialize() {
        mBackPressCloseHandler = new BackPressCloseHandler(this);
    }


    @Override
    public void onBackPressed() {
        mBackPressCloseHandler.onBackPressed();
    }
}
