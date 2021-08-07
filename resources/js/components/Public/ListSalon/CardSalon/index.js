import React from 'react';
import Card from '@material-ui/core/Card';
import CardHeader from '@material-ui/core/CardHeader';
import CardMedia from '@material-ui/core/CardMedia';
import CardContent from '@material-ui/core/CardContent';
import CardActions from '@material-ui/core/CardActions';
import Avatar from '@material-ui/core/Avatar';
import IconButton from '@material-ui/core/IconButton';
import Typography from '@material-ui/core/Typography';
import FavoriteIcon from '@material-ui/icons/Favorite';
import { Link } from '@material-ui/core';
import { cardSalon } from './style';



export default function CardSalon(props) {

  const classes = cardSalon();
  const {id, title, main_photo, city, address, phone, description, rating} = props.salon;

  return (
    <><Link href={`/salon/${id}`}>
       <Card elevation={4}>
      <CardHeader
        avatar={
          <Avatar aria-label="recipe" className={classes.avatar}>
            {title[0]}
          </Avatar>
        }
        title={title}
        subheader={`${city}, ${address}`}
      />
      <CardMedia
        className={classes.media}
        image={main_photo}
        title="Paella dish"
      />
      <CardContent>
        <Typography variant="body2" color="textSecondary" component="p">
          {description}
        </Typography>
      </CardContent>
      <CardActions disableSpacing>
        <IconButton aria-label="add to favorites">
          <FavoriteIcon />
        </IconButton>
      </CardActions>
    </Card>
    </Link>
    </>
   
  );
}