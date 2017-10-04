package com.club.sports.sportsclub.home;

import android.app.TabActivity;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;

import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TabHost;
import android.widget.TextView;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.alert.AlertHomeActivity;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.tab.TabContestInfoActivity;
import com.club.sports.sportsclub.tab.TabGroupActivity;
import com.club.sports.sportsclub.tab.TabHomeActivity;
import com.club.sports.sportsclub.tab.TabMyInfoActivity;
import com.club.sports.sportsclub.tab.TabRankActivity;

/**
 * Created by again on 2017-09-12.
 */

public class SportsClubHomeActivity extends TabActivity {

    private static final int HOME = 0;
    private static final int CONTEST = 1;
    private static final int GROUP = 2;
    private static final int RANK = 3;
    private static final int MY_INFO = 4;
    private static final float FONT_SIZE = 10.0f;

    private BackPressCloseHandler mBackPressCloseHandler;
    private TabHost mTabHost;
    private TabHost.TabSpec mSpec;
    private Intent mIntent;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sportsclub_home);

        initialize();
    }

    private void initialize() {
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        initializeTab();
    }

    private void initializeTab() {
        mTabHost = getTabHost();

        applyIntentHome();
        applyIntentContest();
        applyIntentGroup();
        applyIntentRank();
        applyIntentMyInfo();
        applyIntentTextColor();
        setTabTextViewColor(HOME);

        startTabChanged();
    }

    private void applyIntentHome() {
        mIntent = new Intent().setClass(this, TabHomeActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.home_name)).setIndicator(getResources().getString(R.string.home)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentContest() {
        mIntent = new Intent().setClass(this, TabContestInfoActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.contest_name)).setIndicator(getResources().getString(R.string.contest_info)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentGroup() {
        mIntent = new Intent().setClass(this, TabGroupActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.group_name)).setIndicator(getResources().getString(R.string.group)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentRank() {
        mIntent = new Intent().setClass(this, TabRankActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.rank_name)).setIndicator(getResources().getString(R.string.rank)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentMyInfo() {
        mIntent = new Intent().setClass(this, TabMyInfoActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.my_info_name)).setIndicator(getResources().getString(R.string.my_info)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }


    private void applyIntentTextColor() {
        for (int i = 0; i < getTabWidget().getChildCount(); i++) {
            TextView textView = (TextView) mTabHost.getTabWidget().getChildAt(i).findViewById(android.R.id.title);
            textView.setTextColor(Color.DKGRAY);
            textView.setTextSize(FONT_SIZE);
        }
    }

    private void startTabChanged() {
        mTabHost.setOnTabChangedListener(new TabHost.OnTabChangeListener() {
            @Override
            public void onTabChanged(String tabId) {
                findTabChanged(tabId);
            }
        });
    }

    private void findTabChanged(String tabId) {
        applyIntentTextColor();

        switch (tabId) {
            case "Home":
                setTabTextViewColor(HOME);
                break;
            case "Contest":
                setTabTextViewColor(CONTEST);
                break;
            case "Group":
                setTabTextViewColor(GROUP);
                break;
            case "Rank":
                setTabTextViewColor(RANK);
                break;
            case "MyInfo":
                setTabTextViewColor(MY_INFO);
                break;
        }
    }

    private void setTabTextViewColor(int index) {
        TextView textView = (TextView) mTabHost.getTabWidget().getChildAt(index).findViewById(android.R.id.title);
        textView.setTextColor(Color.BLUE);
    }

    @Override
    public void onBackPressed() {
        mBackPressCloseHandler.onBackPressed();
    }
}
