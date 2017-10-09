package com.club.sports.sportsclub.tab;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.tab.club.TabAllGroupActivity;
import com.club.sports.sportsclub.tab.rank.TabAllRankIActivity;

/**
 * Created by again on 2017-09-23.
 */

public class TabRankActivity extends AppCompatActivity {

    private TextView mRankMenuButton;

    private BackPressCloseHandler mBackPressCloseHandler;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sprotsclub_rank_index_1);

        initialize();
    }

    private void initialize() {
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        findView();
        onClickButton();
    }

    private void findView() {
        mRankMenuButton = (TextView) findViewById(R.id.rank_menu_button);
    }

    private void onClickButton() {
        mRankMenuButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent().setClass(TabRankActivity.this, TabAllRankIActivity.class);
                startActivity(intent);
            }
        });
    }

    @Override
    public void onBackPressed() {
        mBackPressCloseHandler.onBackPressed();
    }
}
