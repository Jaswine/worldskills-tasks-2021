import React from 'react';
import styles from './Snow.module.scss';
import Carrot from '../../media/Game_assets/Projectiles/carrot.svg';
import { useState } from 'react';

function Snow({left, top,transform}) {

  const distance = {
    left: `${left}vw`,
    top: `${top}vh`,
    position: 'fixed',
    transition: 'all 2s ease-in-out',
    transform: transform,
  }

  return (
    <img 
    src={Carrot} 
    alt="" 
    className={styles.snow} 
    style={
      distance
    }
    />
  )
}

export default Snow