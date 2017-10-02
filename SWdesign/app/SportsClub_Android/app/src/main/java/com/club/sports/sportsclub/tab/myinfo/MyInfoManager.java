package com.club.sports.sportsclub.tab.myinfo;

import android.app.Activity;
import android.content.Intent;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.home.SportsClubHomeActivity;
import com.club.sports.sportsclub.main.SportsClubMainActivity;
import com.club.sports.sportsclub.tab.TabMyInfoActivity;

/**
 * Created by again on 2017-10-03.
 */

public class MyInfoManager{

    private Activity mActivity;
    private LinearLayout mMyInfoImageLinearlayout;
    private LinearLayout mMyInfoAliasLinearlayout;
    private LinearLayout mMyInfoMemberOutLinearlayout;
    private LinearLayout mMyInfoLogoutLinearlayout;
    private LinearLayout mMyInfoNoticeLinearlayout;
    private LinearLayout mMyInfoSendLinearlayout;
    private LinearLayout mMyInfoRuleLinearlayout;
    private LinearLayout mMyInfoAppVersionLinearlayout;
    private ImageView mMyInfoProfileImageview;
    private TextView mMyInfoProfileAliasTextview;
    private TextView mMyInfoProfileNameEmailTextview;
    private TextView mMyInfoProfileClubTextview;


    public MyInfoManager(Activity activity) {
        this.mActivity = activity;
    }

    public void initialize() {
        findView();
        onClickButton();
    }

    private void findView() {
        mMyInfoImageLinearlayout = (LinearLayout) mActivity.findViewById(R.id.my_info_image_linearlayout);
        mMyInfoAliasLinearlayout = (LinearLayout) mActivity.findViewById(R.id.my_info_alias_linearlayout);
        mMyInfoMemberOutLinearlayout = (LinearLayout) mActivity.findViewById(R.id.my_info_member_out_linearlayout);
        mMyInfoLogoutLinearlayout = (LinearLayout) mActivity.findViewById(R.id.my_info_logout_linearlayout);
        mMyInfoNoticeLinearlayout = (LinearLayout) mActivity.findViewById(R.id.my_info_notice_linearlayout);
        mMyInfoSendLinearlayout = (LinearLayout) mActivity.findViewById(R.id.my_info_send_linearlayout);
        mMyInfoRuleLinearlayout = (LinearLayout) mActivity.findViewById(R.id.my_info_rule_linearlayout);
        mMyInfoAppVersionLinearlayout = (LinearLayout) mActivity.findViewById(R.id.my_info_app_version_linearlayout);
    }

    private void onClickButton() {
        mMyInfoImageLinearlayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(mActivity, "준비중", Toast.LENGTH_LONG).show();
                return;
            }
        });

        mMyInfoAliasLinearlayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(mActivity, AliasModifyActivity.class);
                intent.putExtra("alias_name", mMyInfoProfileAliasTextview.getText().toString());
                mActivity.startActivityForResult(intent, 1);

            }
        });

        mMyInfoMemberOutLinearlayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(mActivity, "준비중", Toast.LENGTH_LONG).show();
                return;
            }
        });

        mMyInfoLogoutLinearlayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent().setClass(mActivity, SportsClubMainActivity.class);
                mActivity.startActivity(intent);
                mActivity.finish();
                Toast.makeText(mActivity, "로그아웃이 성공적으로 되었습니다.", Toast.LENGTH_LONG).show();
                return;
            }
        });

        mMyInfoNoticeLinearlayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(mActivity, "준비중", Toast.LENGTH_LONG).show();
                return;
            }
        });

        mMyInfoSendLinearlayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(mActivity, "준비중", Toast.LENGTH_LONG).show();
                return;
            }
        });

        mMyInfoRuleLinearlayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(mActivity, "준비중", Toast.LENGTH_LONG).show();
                return;
            }
        });

        mMyInfoAppVersionLinearlayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(mActivity, "준비중", Toast.LENGTH_LONG).show();
                return;
            }
        });
    }





    public void setMyInfoProfileImageview(ImageView imageview) {
        this.mMyInfoProfileImageview = imageview;
    }

    public void setMyInfoProfileAliasTextview(TextView textview) {
        this.mMyInfoProfileAliasTextview = textview;
    }

    public void setMyInfoProfileNameEmailTextview(TextView textview) {
        this.mMyInfoProfileNameEmailTextview = textview;
    }

    public void setMyInfoProfileClubTextview(TextView textview) {
        this.mMyInfoProfileClubTextview = textview;
    }

    public void setAliasTextView(String text) {
        mMyInfoProfileAliasTextview.setText(text);
    }

}
