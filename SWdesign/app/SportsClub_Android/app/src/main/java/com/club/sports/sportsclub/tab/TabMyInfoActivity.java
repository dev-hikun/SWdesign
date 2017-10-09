package com.club.sports.sportsclub.tab;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.tab.myinfo.MyInfoManager;
import com.club.sports.sportsclub.tab.myinfo.TabSettingMyInfoActivity;

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
    private TextView mSettingMenuButton;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sprotsclub_my_info_index_1);

        initialize();
    }

    private void initialize() {
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        findView();
        onClickButton();
        initMyInfoManager();
    }

    private void findView() {
        mMyInfoProfileImageview = (ImageView) findViewById(R.id.my_info_profile_imageview);
        mMyInfoProfileAliasTextview = (TextView) findViewById(R.id.my_info_profile_alias_textview);
        mMyInfoProfileNameEmailTextview = (TextView) findViewById(R.id.my_info_profile_name_email_textview);
        mMyInfoProfileClubTextview = (TextView) findViewById(R.id.my_info_profile_club_textview);
        mSettingMenuButton = (TextView) findViewById(R.id.setting_menu_button);

    }


    private void onClickButton() {
        mSettingMenuButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent().setClass(TabMyInfoActivity.this, TabSettingMyInfoActivity.class);
                startActivity(intent);
            }
        });
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
