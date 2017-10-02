package com.club.sports.sportsclub.tab;

import android.app.TabActivity;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
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

public class TabContestInfoActivity extends TabActivity{

    private static final int TOTAL_CONTEST = 0;
    private static final int PUBLIC_CONTEST = 1;
    private static final int FEINDSHIP_CONTEST = 2;
    private static final int CONTEST_MANAGEMENT = 3;
    private static final float FONT_SIZE = 10.0f;

    private BackPressCloseHandler mBackPressCloseHandler;
    private TabHost mTabHost;
    private TabHost.TabSpec mSpec;
    private Intent mIntent;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sprotsclub_contest_index_1);

        initialize();
    }

    private void initialize() {
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        initializeTab();
    }

    private void initializeTab() {
        mTabHost = getTabHost();

        applyIntentTotalContest();
        applyIntentPublicContest();
        applyIntentFriendshipContest();
        applyIntentContestManagement();
        applyIntentTextColor();
        setTabTextViewColor(TOTAL_CONTEST);

        startTabChanged();
    }

    private void applyIntentTotalContest() {
        mIntent = new Intent().setClass(this, TabTotalContestActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.contest_total_name)).setIndicator(getResources().getString(R.string.contest_total)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentPublicContest() {
        mIntent = new Intent().setClass(this, TabPublicContestActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.contest_public_name)).setIndicator(getResources().getString(R.string.contest_public)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentFriendshipContest() {
        mIntent = new Intent().setClass(this, TabFriendshipContestActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.contest_friendship_name)).setIndicator(getResources().getString(R.string.contest_friendship)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentContestManagement() {
        mIntent = new Intent().setClass(this, TabContestManagementActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.contest_management_name)).setIndicator(getResources().getString(R.string.contest_management)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }


    private void applyIntentTextColor() {
        for (int i = 0; i < getTabWidget().getChildCount(); i++) {
            TextView textView = (TextView) mTabHost.getTabWidget().getChildAt(i).findViewById(android.R.id.title);
            textView.setTextColor(Color.WHITE);
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
        switch (tabId) {
            case "ContestTotal":
                applyIntentTextColor();
                setTabTextViewColor(TOTAL_CONTEST);
                break;
            case "ContestPublic":
                applyIntentTextColor();
                setTabTextViewColor(PUBLIC_CONTEST);
                break;
            case "ContestFriendship":
                applyIntentTextColor();
                setTabTextViewColor(FEINDSHIP_CONTEST);
                break;
            case "ContestManagement":
                applyIntentTextColor();
                setTabTextViewColor(CONTEST_MANAGEMENT);
                break;
        }
    }

    private void setTabTextViewColor(int index) {
        TextView textView = (TextView) mTabHost.getTabWidget().getChildAt(index).findViewById(android.R.id.title);
        textView.setTextColor(Color.BLACK);
    }

    @Override
    public void onBackPressed() {
        mBackPressCloseHandler.onBackPressed();
    }
}
