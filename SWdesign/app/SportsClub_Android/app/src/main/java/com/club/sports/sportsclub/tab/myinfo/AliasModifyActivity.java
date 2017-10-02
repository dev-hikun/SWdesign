package com.club.sports.sportsclub.tab.myinfo;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.EditText;
import android.widget.RelativeLayout;
import android.widget.Toast;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.tab.TabMyInfoActivity;

/**
 * Created by again on 2017-09-23.
 */

public class AliasModifyActivity extends AppCompatActivity {

    private RelativeLayout mAliasApplyRelativelayout;
    private RelativeLayout mAliasCancelRelativelayout;
    private EditText mAliasApplyEdittext;
    private Activity mActivity;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sprotsclub_my_info_alias);

        initialize();
    }

    private void initialize() {
        mActivity = this;
        findView();
        settingIntent();
        onClickButton();
    }

    private void findView() {
        mAliasApplyRelativelayout = (RelativeLayout) findViewById(R.id.alias_apply_relativelayout);
        mAliasCancelRelativelayout = (RelativeLayout) findViewById(R.id.alias_cancel_relativelayout);
        mAliasApplyEdittext = (EditText) findViewById(R.id.alias_apply_edittext);
    }

    private void settingIntent() {
        Intent intent = getIntent();
        mAliasApplyEdittext.setText(intent.getExtras().getString("alias_name"));
    }

    private void onClickButton() {
        mAliasApplyRelativelayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(mActivity, "닉네임 변경 완료", Toast.LENGTH_LONG).show();
                Intent intent = new Intent();
                intent.putExtra("result", mAliasApplyEdittext.getText().toString());
                setResult(Activity.RESULT_OK, intent);
                finish();
            }
        });

        mAliasCancelRelativelayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }

}
