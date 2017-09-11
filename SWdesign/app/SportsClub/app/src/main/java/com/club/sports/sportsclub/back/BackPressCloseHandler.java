package com.club.sports.sportsclub.back;

import android.app.Activity;
import android.support.v7.app.AppCompatActivity;
import android.widget.Toast;

import com.club.sports.sportsclub.R;

/**
 * Created by Administrator on 2017-09-12.
 */
public class BackPressCloseHandler extends AppCompatActivity {

    private long mBackKeyPressedTime = 0;
    private Toast mToast;

    private Activity mActivity;

    public BackPressCloseHandler(Activity activity){
        this.mActivity = activity;
    }

    @Override
    public void onBackPressed() {
        compareTimer();
    }

    private void compareTimer(){
        if(System.currentTimeMillis() > mBackKeyPressedTime + 2000){
            mBackKeyPressedTime = System.currentTimeMillis();
            showGuide();
            return;
        }
        if(System.currentTimeMillis() <= mBackKeyPressedTime + 2000) {
            moveTaskToBack(true);
            finish();
            android.os.Process.killProcess(android.os.Process.myPid());
            System.exit(0);
            mToast.cancel();
        }
    }

    private void showGuide(){
        mToast = Toast.makeText(mActivity, mActivity.getResources().getString(R.string.back_quit), Toast.LENGTH_SHORT);
        mToast.show();
    }
}
