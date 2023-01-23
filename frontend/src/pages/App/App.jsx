import styles from './App.module.scss';
import snowman from '../../media/Game_assets/Snowman/snowman.svg';
import Snowman from '../../components/SnowMan/Snowman';
import StartForm from '../../components/StartForm/StartForm';
import Layout from '../../components/Layout/Layout';
import Game from '../Game/Game';

function App() {
  return (
    <Layout>
      <div className={styles.back}>
        <StartForm/>
        {/* <Snowman/> */}
        <Game/>
      </div>
    </Layout>
  );
}

export default App;
