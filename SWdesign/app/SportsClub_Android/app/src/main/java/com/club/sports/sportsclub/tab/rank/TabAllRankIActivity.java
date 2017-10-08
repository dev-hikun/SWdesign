package com.club.sports.sportsclub.tab.rank;

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

public class TabAllRankIActivity extends TabActivity {

    private static final int TOTAL_RANK = 0;
    private static final int MY_RANK = 1;
    private static final float FONT_SIZE = 10.0f;

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
        initializeTab();
    }

    private void initializeTab() {
        mTabHost = getTabHost();

        applyIntentTotalRank();
        applyIntentMyRank();
        applyIntentTextColor();
        setTabTextViewColor(TOTAL_RANK);

        startTabChanged();
    }

    private void applyIntentTotalRank() {
        mIntent = new Intent().setClass(this, TabTotalRankActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.total_rank_name)).setIndicator(getResources().getString(R.string.total_rank)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentMyRank() {
        mIntent = new Intent().setClass(this, TabMyRankActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.my_rank_name)).setIndicator(getResources().getString(R.string.my_rank)).setContent(mIntent);
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
        switch (tabId) {
            case "TotalRank":
                applyIntentTextColor();
                setTabTextViewColor(TOTAL_RANK);
                break;
            case "MyRank":
                applyIntentTextColor();
                setTabTextViewColor(MY_RANK);
                break;
        }
    }

    private void setTabTextViewColor(int index) {
        TextView textView = (TextView) mTabHost.getTabWidget().getChildAt(index).findViewById(android.R.id.title);
        textView.setTextColor(Color.BLUE);
    }

}
