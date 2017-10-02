package com.club.sports.sportsclub.tab;

import android.app.TabActivity;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.widget.TabHost;
import android.widget.TextView;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.tab.club.TabClubListActivity;
import com.club.sports.sportsclub.tab.club.TabClubManagementActivity;
import com.club.sports.sportsclub.tab.club.TabClubRegisterActivity;

/**
 * Created by again on 2017-09-23.
 */

public class TabGroupActivity extends TabActivity {

    private static final int CLUB_LIST = 0;
    private static final int CLUB_REGISTER = 1;
    private static final int CLUB_MANAGEMENT = 2;
    private static final float FONT_SIZE = 10.0f;

    private BackPressCloseHandler mBackPressCloseHandler;
    private TabHost mTabHost;
    private TabHost.TabSpec mSpec;
    private Intent mIntent;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sportsclub_list);

        initialize();
    }

    private void initialize() {
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        initializeTab();
    }

    private void initializeTab() {
        mTabHost = getTabHost();

        applyIntentClubList();
        applyIntentClubRegister();
        applyIntentClubManagement();
        applyIntentTextColor();
        setTabTextViewColor(CLUB_LIST);

        startTabChanged();
    }

    private void applyIntentClubList() {
        mIntent = new Intent().setClass(this, TabClubListActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.club_list_name)).setIndicator(getResources().getString(R.string.club_list)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentClubRegister() {
        mIntent = new Intent().setClass(this, TabClubRegisterActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.club_register_name)).setIndicator(getResources().getString(R.string.club_register)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentClubManagement() {
        mIntent = new Intent().setClass(this, TabClubManagementActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.club_management_name)).setIndicator(getResources().getString(R.string.club_management)).setContent(mIntent);
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
            case "ClubList":
                applyIntentTextColor();
                setTabTextViewColor(CLUB_LIST);
                break;
            case "ClubRegister":
                applyIntentTextColor();
                setTabTextViewColor(CLUB_REGISTER);
                break;
            case "ClubManagement":
                applyIntentTextColor();
                setTabTextViewColor(CLUB_MANAGEMENT);
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
