package ma.me.amirez.orientawjih;

import android.support.v7.app.AppCompatActivity;
import android.widget.Toast;

/**
 * Created by HP on 26/04/2017.
 */

public class Incription extends AppCompatActivity{
    Etudiant etd;
    Server s;
    public Incription()
    {
        s.addUser(etd);
        Toast.makeText(this,"Inscription Effectue",Toast.LENGTH_LONG).show();
    }
}
