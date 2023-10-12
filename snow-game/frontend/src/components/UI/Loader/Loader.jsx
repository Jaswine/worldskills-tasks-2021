import React from 'react';
import styles from './Loader.module.scss';
import snowman from '../../../media/Game_assets/Snowman/snowman.svg';
import Igloo from '../../../media/Game_assets/Object/Igloo.png';
import Crystal from '../../../media/Game_assets/Object/Crystal.png';
import Tree from '../../../media/Game_assets/Object/Tree_2.png';
import Trees from '../../../media/Game_assets/Object/Tree_1.png';
import Sign_2 from '../../../media/Game_assets/Object/Sign_2.png';


function Loader() {
  return (
    <div className={styles.loader}>
      <div className={styles.loader__animation}>
        <img src={Trees} className={styles.trees1}/>
        <img src={Trees} className={styles.Trees2}/>
        <img src={Igloo} className={styles.igloo}/>
        <img src={snowman} className={styles.snowman}/>
        <img src={Tree} className={styles.Tree1}/>
        <img src={Tree} className={styles.Tree2}/>
        <img src={Sign_2} className={styles.sign2}/>
        <img src={Crystal} className={styles.crystal}/>
      </div>
    </div>
  )
}

export default Loader