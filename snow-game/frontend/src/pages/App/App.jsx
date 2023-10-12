import styles from './App.module.scss';
import snowman from '../../media/Game_assets/Snowman/snowman.svg';
import Snowman from '../../components/SnowMan/Snowman';
import StartForm from '../../components/StartForm/StartForm';
import Layout from '../../components/Layout/Layout';
import Game from '../../components/Game/Game';
import Live from '../../components/live/Live';
import { useEffect, useState } from 'react';
import EndForm from '../../components/EndForm/EndForm';

function App() {
  const [live, setLive] = useState(3);

  return (
    <Layout>
      <div className={styles.back}>
      <Live live ={live} setLive={setLive} />
      {live ===  -1? (<EndForm/>  ):  <Game setLive={setLive} live={live} />}
        <StartForm/>
      </div>
    </Layout>
  );
}

export default App;
