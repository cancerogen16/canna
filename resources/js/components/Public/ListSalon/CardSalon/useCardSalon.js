import React from 'react';

export default useCardSalon = () => {
    const [expanded, setExpanded] = React.useState(false);

    const handleExpandClick = () => {
        setExpanded(!expanded);
    };

    return {
        expanded,
        handleExpandClick
    }
} 