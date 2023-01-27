import React from 'react';
import styles from './Snow.module.scss';
import Carrot from '../../media/Game_assets/Projectiles/carrot.svg';

function Snow() {
  return (
    <img src={Carrot} alt="" className={styles.snow} />
  )
}

export default Snow