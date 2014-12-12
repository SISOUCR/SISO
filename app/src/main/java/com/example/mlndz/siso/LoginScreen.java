package com.example.mlndz.siso;

import android.content.Intent;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;


public class LoginScreen extends ActionBarActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login_screen);
        EditText ed = (EditText) findViewById(R.id.editText);
        //ed.setSelection(0, ed.length());
        ed.addTextChangedListener(watch);
        EditText pass = (EditText) findViewById(R.id.editText2);
        pass.addTextChangedListener(watch2);
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.login_screen, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        if (id == R.id.action_settings) {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    public void buttonOnClick(View v) {
        /*Button butt= (Button)v;
        butt.setText("Sup yoh?");

        TextView txv= (TextView)findViewById(R.id.textView);
        txv.setText("Damn!");*/

    }

    public void disappearText(View v) {
        EditText ed = (EditText) v;
        //ed.setSelection(0, ed.length());
        ed.addTextChangedListener(watch);

    }


    TextWatcher watch = new TextWatcher() {
        @Override
        public void beforeTextChanged(CharSequence s, int start, int count, int after) {

        }

        @Override
        public void onTextChanged(CharSequence s, int start, int before, int count) {
            TextView tx = (TextView) findViewById(R.id.textView);
            if (count != 0) {
                tx.setText("");
            } else {
                tx.setText("   Nombre de Usuario");
            }
        }

        @Override
        public void afterTextChanged(Editable s) {

        }
    };

    TextWatcher watch2 = new TextWatcher() {
        @Override
        public void beforeTextChanged(CharSequence s, int start, int count, int after) {

        }

        @Override
        public void onTextChanged(CharSequence s, int start, int before, int count) {
            TextView tx2 = (TextView) findViewById(R.id.textView2);
            //if(count!=0){
            tx2.setText("");
            /*}else{
                tx2.setText("   Contraseña");
            }*/
        }

        @Override
        public void afterTextChanged(Editable s) {

        }
    };


    public void onDatClick(View v) {

        Intent nextScreen = new Intent(getApplicationContext(), SecondScreen.class);
        EditText etx = (EditText) findViewById(R.id.editText);
        EditText etx2 = (EditText) findViewById(R.id.editText2);
        String username = etx.getText().toString();
        String password = etx2.getText().toString();
        nextScreen.putExtra("username", username);
        nextScreen.putExtra("password", password);

        startActivity(nextScreen);
        //TextW

    }

    public void onDatAnotherClick(View v) {

        Intent nextScreeen = new Intent(getApplicationContext(), eventoshome.class);
        startActivity(nextScreeen);
        //TextW

    }


}
