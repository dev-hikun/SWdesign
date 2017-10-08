package com.club.sports.sportsclub.tab;

import android.app.TabActivity;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TabHost;
import android.widget.TextView;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.tab.club.TabAllGroupActivity;
import com.club.sports.sportsclub.tab.club.TabClubListActivity;
import com.club.sports.sportsclub.tab.club.TabClubManagementActivity;
import com.club.sports.sportsclub.tab.club.TabClubRegisterActivity;
import com.club.sports.sportsclub.tab.contests.TabAllContestIActivity;

/**
 * Created by again on 2017-09-23.
 */

public class TabGroupActivity extends AppCompatActivity {

    private TextView mClubMenuButton;

    private BackPressCloseHandler mBackPressCloseHandler;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sprotsclub_group_index_1);

        initialize();
    }

    private void initialize() {
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        findView();
        onClickButton();
    }

    private void findView() {
        mClubMenuButton = (TextView) findViewById(R.id.club_menu_button);
    }

    private void onClickButton() {
        mClubMenuButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent().setClass(TabGroupActivity.this, TabAllGroupActivity.class);
                startActivity(intent);
            }
        });
    }

    @Override
    public void onBackPressed() {
        mBackPressCloseHandler.onBackPressed();
    }
}
