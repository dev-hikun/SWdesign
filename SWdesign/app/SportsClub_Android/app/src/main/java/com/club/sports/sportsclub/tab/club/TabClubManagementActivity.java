package com.club.sports.sportsclub.tab.club;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;

/**
 * Created by again on 2017-09-12.
 */

public class TabClubManagementActivity extends AppCompatActivity {

    private BackPressCloseHandler mBackPressCloseHandler;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sportsclub_list_index_3);

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
