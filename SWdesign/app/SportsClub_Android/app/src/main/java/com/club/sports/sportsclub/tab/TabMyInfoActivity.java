package com.club.sports.sportsclub.tab;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.ImageView;
import android.widget.TextView;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.tab.myinfo.MyInfoManager;

/**
 * Created by again on 2017-09-23.
 */

public class TabMyInfoActivity extends AppCompatActivity {

    private BackPressCloseHandler mBackPressCloseHandler;
    private MyInfoManager mMyInfoManager;
    private ImageView mMyInfoProfileImageview;
    private TextView mMyInfoProfileAliasTextview;
    private TextView mMyInfoProfileNameEmailTextview;
    private TextView mMyInfoProfileClubTextview;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sprotsclub_my_info);

        initialize();
    }

    private void initialize() {
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        findView();
        initMyInfoManager();
    }

    private void findView() {
        mMyInfoProfileImageview = (ImageView) findViewById(R.id.my_info_profile_imageview);
        mMyInfoProfileAliasTextview = (TextView) findViewById(R.id.my_info_profile_alias_textview);
        mMyInfoProfileNameEmailTextview = (TextView) findViewById(R.id.my_info_profile_name_email_textview);
        mMyInfoProfileClubTextview = (TextView) findViewById(R.id.my_info_profile_club_textview);
    }

    private void initMyInfoManager() {
        mMyInfoManager = new MyInfoManager(this);
        mMyInfoManager.initialize();
        mMyInfoManager.setMyInfoProfileAliasTextview(mMyInfoProfileAliasTextview);
        mMyInfoManager.setMyInfoProfileNameEmailTextview(mMyInfoProfileNameEmailTextview);
        mMyInfoManager.setMyInfoProfileClubTextview(mMyInfoProfileClubTextview);
        mMyInfoManager.setMyInfoProfileImageview(mMyInfoProfileImageview);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {

        if (requestCode == 1) {
            if(resultCode == Activity.RESULT_OK){
                // 닉네임 변경
                String result = data.getStringExtra("result");
                mMyInfoProfileAliasTextview.setText(result);
            }
            if (resultCode == Activity.RESULT_CANCELED) {
                return;
            }
        }
    }

    @Override
    public void onBackPressed(){
        mBackPressCloseHandler.onBackPressed();
    }

}
