package clases;

/**
 * Created by leo on 12/12/14.
 */
import java.sql.Date;
import java.text.SimpleDateFormat;
import java.util.TimeZone;

public class Event{
    private int id;
    private String title;
    private String description;
    private String location;
    private long start;


    public Event( int id , String title , String description , String location , long start)
    {
        this.setId(id)
                .setTitle(title)
                .setDescription(description)
                .setLocation(location)
                .setStart(start);

    }

    /*
    GETTERS
    */
    public int getId() { return this.id; }
    public String getTitle() { return this.title; }
    public String getDescription() { return this.description; }
    public String getLocation() { return this.location; }

    public String getStart()
    {
        Date date = new Date( this.start );
        SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd"); // the format of your date
        sdf.setTimeZone(TimeZone.getTimeZone("GMT-6")); // give a timezone reference for formating (see comment at the bottom
        String formattedDate = sdf.format(date);

        return formattedDate;
    }



    /*
    SETTERS
    */
    public Event setId( int id )
    {
        this.id = id;
        return this;
    }
    public Event setTitle( String title )
    {
        this.title = title;
        return this;
    }
    public Event setDescription( String description )
    {
        this.description = description;
        return this;
    }
    public Event setLocation( String location )
    {
        this.location = location;
        return this;
    }
    public Event setStart( long start )
    {
        this.start = start;
        return this;
    }

}