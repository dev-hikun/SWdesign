package com.club.sports.sportsclub.tab;

import android.graphics.Color;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.TextView;

/**
 * Created by again on 2017-09-23.
 */

public class TabMyInfoActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        TextView tv = new TextView(this);
        tv.setText("대회 정보 내용4");
        tv.setTextSize(22);
        tv.setTextColor(Color.BLUE);
        setContentView(tv);
    }
}
