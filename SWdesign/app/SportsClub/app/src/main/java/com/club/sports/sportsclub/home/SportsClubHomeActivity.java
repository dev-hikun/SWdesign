package com.club.sports.sportsclub.home;

import android.app.TabActivity;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;

import android.view.View;
import android.widget.ImageView;
import android.widget.TabHost;
import android.widget.TextView;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.tab.TabContestInfoActivity;
import com.club.sports.sportsclub.tab.TabGroupActivity;
import com.club.sports.sportsclub.tab.TabMyInfoActivity;
import com.club.sports.sportsclub.tab.TabRankActivity;

/**
 * Created by again on 2017-09-12.
 */

public class SportsClubHomeActivity extends TabActivity{

    private BackPressCloseHandler mBackPressCloseHandler;
    private TabHost mTabHost;
    private TabHost.TabSpec mSpec;
    private Intent mIntent;
    private ImageView mTopLogoImageView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sportsclub_home);

        initialize();
    }

    private void initialize(){
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        findView();
        initializeTab();
        onClickTopLogoImageView();
    }

    private void findView(){
        mTopLogoImageView = (ImageView) findViewById(R.id.top_logo);
    }

    private void initializeTab(){
        mTabHost = getTabHost();

        applyIntentContest();
        applyIntentGroup();
        applyIntentRank();
        applyIntentMyInfo();
        applyIntentTextColor();
    }

    private void onClickTopLogoImageView(){
        mTopLogoImageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                mIntent = new Intent().setClass(SportsClubHomeActivity.this, SportsClubHomeActivity.class);
                startActivity(mIntent);
                finish();
            }
        });
    }

    private void applyIntentContest(){
        mIntent = new Intent().setClass(this, TabContestInfoActivity.class);
        mSpec = mTabHost.newTabSpec("Contest").setIndicator("대회 정보", getResources().getDrawable(R.drawable.contest_info)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentGroup(){
        mIntent = new Intent().setClass(this, TabGroupActivity.class);
        mSpec = mTabHost.newTabSpec("Group").setIndicator("클럽", getResources().getDrawable(R.drawable.group)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentRank(){
        mIntent = new Intent().setClass(this, TabRankActivity.class);
        mSpec = mTabHost.newTabSpec("Rank").setIndicator("랭킹", getResources().getDrawable(R.drawable.rank)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentMyInfo(){
        mIntent = new Intent().setClass(this, TabMyInfoActivity.class);
        mSpec = mTabHost.newTabSpec("MyInfo").setIndicator("내 정보", getResources().getDrawable(R.drawable.my)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentTextColor(){
        for(int i = 0; i<getTabWidget().getChildCount(); i++) {
            TextView textView = (TextView) mTabHost.getTabWidget().getChildAt(i).findViewById(android.R.id.title);
            textView.setTextColor(Color.BLACK);
        }
    }

    @Override
    public void onBackPressed(){
        mBackPressCloseHandler.onBackPressed();
    }
}
