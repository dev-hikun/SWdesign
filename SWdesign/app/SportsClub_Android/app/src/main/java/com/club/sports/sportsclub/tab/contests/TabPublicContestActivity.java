package com.club.sports.sportsclub.tab.contests;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;

/**
 * Created by again on 2017-09-12.
 */

public class TabPublicContestActivity extends AppCompatActivity {

    private BackPressCloseHandler mBackPressCloseHandler;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sprotsclub_contest_index_1_2);

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
