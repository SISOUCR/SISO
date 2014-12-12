package com.example.leo.feed1;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.text.Editable;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;


public class MainActivity extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    public void buttonOnClick(View v){

        Intent intent = new Intent(MainActivity.this, MainActivity2.class);
        startActivity(intent);
        //finish();



      /*  AlertDialog.Builder alert = new AlertDialog.Builder(this);

        alert.setTitle("Evento Nuevo");
        alert.setMessage("Nombre");


// Set an EditText view to get user input
        final EditText input = new EditText(this);
        alert.setView(input);

        alert.setMessage("Fecha");
        final EditText input2 = new EditText(this);
        alert.setView(input2);


        alert.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int whichButton) {
                Editable value = input.getText();
                // Do something with value!
            }
        });

        alert.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int whichButton) {
                // Canceled.
            }
        });

        alert.show();


*/



       /*new AlertDialog.Builder(this)
                .setTitle("Delete entry")
                .setMessage("Are you sure you want to delete this entry?")
                .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        // continue with delete
                    }
                })
                .setNegativeButton(android.R.string.no, new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        // do nothing
                    }
                })
                .setIcon(android.R.drawable.ic_dialog_alert)
                .show();*/

     /*   Button button=(Button) v;
        button.setText("I've Been Clicked!");
        TextView myTextView=(TextView)
                findViewById(R.id.textView);
       */


    }

    /*public void onClick(View view) {
        AlertDialog.Builder alertDialog = new AlertDialog.Builder(MainActivity.this);
        LayoutInflater inflater = getLayoutInflater();
        // el layout device combination input es su xml base, por ejemplo el mio es un scrollview y
        // dentro del scrollview hay un linearlayout que se llama lineaerlayoutcombinacion que se usa
        // mas adelante que es donde voy agregando linearlayout dinamicamente a como necesite
        View convertView = (View) inflater.inflate(R.layout.device_combination_input, null);
        alertDialog.setView(convertView);
        alertDialog.setTitle("Nueva combinación");
        LinearLayout lv = (LinearLayout) convertView.findViewById(R.id.linearLayoutCombination);
        alertDialog.setPositiveButton("Agregar",
                new DialogInterface.OnClickListener() {

                    @Override
                    public void onClick(DialogInterface dialog, int which) {

                        // aqui codigo que quiere que se haga cuando le da el positive button

                        dialog.dismiss();
                    }
                });
        alertDialog.setNegativeButton("Cancelar",
                new DialogInterface.OnClickListener() {

                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        // aqui no deberia ir codigo xq si presiona cancelar uno solo querria que se cierre y ya

                        dialog.dismiss();
                    }
                });*/


    }
