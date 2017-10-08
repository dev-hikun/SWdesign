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
import com.club.sports.sportsclub.home.SportsClubHomeActivity;
import com.club.sports.sportsclub.tab.contests.TabAllContestIActivity;
import com.club.sports.sportsclub.tab.contests.TabContestManagementActivity;
import com.club.sports.sportsclub.tab.contests.TabFriendshipContestActivity;
import com.club.sports.sportsclub.tab.contests.TabPublicContestActivity;
import com.club.sports.sportsclub.tab.contests.TabTotalContestActivity;

/**
 * Created by again on 2017-09-23.
 */

public class TabContestInfoActivity extends AppCompatActivity{

    private TextView mContestMenuButton;

    private BackPressCloseHandler mBackPressCloseHandler;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sprotsclub_contest_index_1);

        initialize();
    }

    private void initialize() {
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        findView();
        onClickButton();
    }

    private void findView() {
        mContestMenuButton = (TextView) findViewById(R.id.contest_menu_button);
    }

    private void onClickButton() {
        mContestMenuButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent().setClass(TabContestInfoActivity.this, TabAllContestIActivity.class);
                startActivity(intent);
            }
        });
    }

    @Override
    public void onBackPressed() {
        mBackPressCloseHandler.onBackPressed();
    }
}
