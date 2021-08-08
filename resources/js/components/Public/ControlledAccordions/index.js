import { Accordion, AccordionDetails, AccordionSummary, makeStyles, Typography } from '@material-ui/core';
import React from 'react';

const useStyles = makeStyles((theme) => ({
    root: {
      width: '100%',
    },
    heading: {
      fontSize: theme.typography.pxToRem(15),
      flexBasis: '33.33%',
      flexShrink: 0,
    },
    secondaryHeading: {
      fontSize: theme.typography.pxToRem(15),
      color: theme.palette.text.secondary,
    },
  }));
  
  export default function ControlledAccordions(props) {
    const classes = useStyles();
    const [expanded, setExpanded] = React.useState(false);
  
    const handleChange = (panel) => (event, isExpanded) => {
      setExpanded(isExpanded ? panel : false);
    };
  
    return (
      <div onClick={props.onClick} className={classes.root}>
        <Accordion expanded={expanded === 'panel1'} onChange={handleChange('panel1')}>
          <AccordionSummary
            // expandIcon={<ExpandMoreIcon />}
            aria-controls="panel1bh-content"
            id="panel1bh-header"
          >
            {props.heading}
          </AccordionSummary>
          <AccordionDetails>
            {props.content}
          </AccordionDetails>
        </Accordion>
       
      </div>
    );
  }