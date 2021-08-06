
import { Checkbox, Divider, FormControlLabel, FormGroup, Link, Modal, TextField } from '@material-ui/core';
import { makeStyles } from '@material-ui/core/styles';
import React, { useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { fetchCategoryAll } from '../../store/category/thunks';

function rand() {
    return Math.round(Math.random() * 20) - 10;
  }
function getModalStyle() {
    const top = 50 + rand();
    const left = 50 + rand();
  
    return {
      top: `${top}%`,
      left: `${left}%`,
      transform: `translate(-${top}%, -${left}%)`,
    };
  }

  const useStyles = makeStyles((theme) => ({
    paper: {
      position: 'absolute',
      width: 400,
      backgroundColor: theme.palette.background.paper,
      border: '2px solid #000',
      boxShadow: theme.shadows[5],
      padding: theme.spacing(2, 4, 3),
    },
  }));

export default function SearchSalon() {
    const categories = useSelector(state => state.categories);
    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(fetchCategoryAll());
    },[])
    const classes = useStyles();
    const [modalStyle] = React.useState(getModalStyle);
    const [open, setOpen] = React.useState(false);

    const handleOpen = () => {
        setOpen(true);
      };
    
      const handleClose = () => {
        setOpen(false);
      };

    return (<div className='search-salon'>
        <div className="search-salon__group">
            <TextField fullWidth type="text" label="Поиск" variant="outlined"></TextField>
        </div>
        <Divider />
        <div className="search-salon__group">
            <h4>Город</h4>
            <Link onClick={handleOpen}>Москва</Link>
        </div>
            
        <Divider />
        <div className="search-salon__group">
            <h4>Категории</h4>
            <FormGroup>
            {categories.map(category => {
                return <FormControlLabel key={category.id}
                control={<Checkbox   name={category.title} />}
                label={category.title}/>
                
            } )}
            </FormGroup>
        </div>
        <Divider />
        <div className="search-salon__group">
            <h4>Услуги</h4>
            <FormGroup>
            <FormControlLabel
                control={<Checkbox   name="gilad" />}
                label="Gilad Gray"
            />
            <FormControlLabel
                control={<Checkbox   name="jason" />}
                label="Jason Killian"
            />
            <FormControlLabel
                control={<Checkbox  name="antoine" />}
                label="Antoine Llorca"
            />
            </FormGroup>
        </div>
            
        <Divider />

        <Modal
            open={open}
            onClose={handleClose}
            aria-labelledby="simple-modal-title"
            aria-describedby="simple-modal-description"
            >
            <div style={modalStyle} className={classes.paper}>
            <h1>test</h1>
            </div>
            
        </Modal>
    </div>);
}