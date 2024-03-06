// withHooks
import { memo } from 'react';

import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import React, { useRef, useState } from 'react';
import {
  View, SafeAreaView,
  Image,
  StyleSheet,
  FlatList,
  Text,
  StatusBar,
  TouchableOpacity,
  Dimensions,
} from 'react-native';
import esp from 'esoftplay/esp';


export interface OnboardingArgs {

}
export interface OnboardingProps {
  navigation: any; 
}

interface SlideComponent {
  id: string;
  image: any;
  title: string;
  subtitle: string;
}

interface SlideComponentProps {
  item: SlideComponent;
}


function m(props: OnboardingProps): any {
  const width = Dimensions.get('window').width;
  const height = Dimensions.get('window').height;
  const COLORS = { primary: '#ffffff', white: '#fff', default: "#146c94", black: "#000" };

  const SlideComponents: SlideComponent[] = [
    {
      id: '1',
      
      image: esp.assets('onboarding1.png'),
      title: 'Selamat Datang',
      subtitle: 'Selamat datang di School! Mari bersama-sama memudahkan pencatatan absensi siswa untuk pengalaman pembelajaran yang lebih baik.',
    },
    
    {
      id: '2',
      image: esp.assets('onboarding2.png'),
      title: 'Absensi Mudah',
      subtitle: 'Dengan School, guru mencatat absensi dengan cepat dan efisien, menciptakan lingkungan pembelajaran yang teratur.',
    },
    {
      id: '3',
      image: esp.assets('onboarding3.png'),
      title: 'Pantau Kemajuan',
      subtitle: 'Orang tua, kini Anda bisa memantau absensi anak secara real-time. Bersama, kita membangun komunikasi yang kuat antara sekolah dan rumah',
    },
  ];

  const [currentSlideComponentIndex, setCurrentSlideComponentIndex] = useState(0);
  const ref = useRef<FlatList<SlideComponent>>(null);

  const updateCurrentSlideComponentIndex = (e: any) => {
    const contentOffsetX = e.nativeEvent.contentOffset.x;
    const currentIndex = Math.round(contentOffsetX / width);
    setCurrentSlideComponentIndex(currentIndex);
  };

  const goToNextSlideComponent = () => {
    const nextSlideComponentIndex = currentSlideComponentIndex + 1;
    if (nextSlideComponentIndex !== SlideComponents.length) {
      const offset = nextSlideComponentIndex * width;
      ref?.current?.scrollToOffset({ offset });
      setCurrentSlideComponentIndex(currentSlideComponentIndex + 1);
    }
  };

  const skip = () => {
    const lastSlideComponentIndex = SlideComponents.length - 1;
    const offset = lastSlideComponentIndex * width;
    ref?.current?.scrollToOffset({ offset });
    setCurrentSlideComponentIndex(lastSlideComponentIndex);
  };

  function SlideComponentComponent({ item }: SlideComponentProps){
    return (
      <View style={{ alignItems: 'center', width, padding: 20 }}>
        <Image
          source={item?.image}
          style={{ height: "50%", width: "80%", resizeMode: 'contain', marginTop: 80, marginBottom: 20 }}
        />
        <View>
          <Text style={styles.title}>{item?.title}</Text>
          <Text style={styles.subtitle}>{item?.subtitle}</Text>
        </View>
      </View>
    );
  };
  
  function Footer(){
    return (
      <View
        style={{
          height: height * 0.25,
          justifyContent: 'space-between',
          paddingHorizontal: 20,
        }}>
        <View
          style={{
            flexDirection: 'row',
            justifyContent: 'center',
            marginTop: 20,
          }}>
          {SlideComponents.map((_, index) => (
            <View
              key={index}
              style={[
                styles.indicator,
                currentSlideComponentIndex === index && {
                  backgroundColor: COLORS.default,
                  width: 25,
                },
              ]}
            />
          ))}
        </View>
        <View style={{ marginBottom: 20 }}>
          {currentSlideComponentIndex === SlideComponents.length - 1 ? (
            <View style={{ height: 50 }}>
              <TouchableOpacity
                style={styles.btn}
                onPress={() => LibNavigation.navigate('auth/login')}>
                <Text style={{ fontWeight: 'bold', fontSize: 15 }}>
                  GET STARTED
                </Text>
              </TouchableOpacity>
            </View>
          ) : (
            <View style={{ flexDirection: 'row', marginBottom: 30 }}>
              <TouchableOpacity
                activeOpacity={0.8}
                style={[
                  styles.btn,
                  {
                    borderColor: COLORS.black,
                    borderWidth: 1,
                    backgroundColor: '#cf717100',
                  },
                ]}
                onPress={skip}>
                <Text
                  style={{
                    fontWeight: 'bold',
                    fontSize: 15,
                    color: COLORS.black,
                  }}>
                  SKIP
                </Text>
              </TouchableOpacity>
              <View style={{ width: 15 }} />
              <TouchableOpacity
                activeOpacity={0.8}
                onPress={goToNextSlideComponent}
                style={styles.btn}>
                <Text
                  style={{
                    fontWeight: 'bold',
                    fontSize: 15,
                  }}>
                  NEXT
                </Text>
              </TouchableOpacity>
            </View>
          )}
        </View>
      </View>
    );
  };
  const styles = StyleSheet.create({
    subtitle: {
      color: "black",
      fontSize: 15,
      marginTop: 10,
      maxWidth: '70%',
      textAlign: 'center',
      lineHeight: 23,
    },
    title: {
      color: "black",
      fontSize: 22,
      fontWeight: 'bold',
      marginTop: 20,
      textAlign: 'center',
    },
    indicator: {
      height: 2.5,
      width: 10,
      backgroundColor: 'grey',
      marginHorizontal: 3,
      borderRadius: 2,
    },
    btn: {
      flex: 1,
      height: 50,
      borderColor: COLORS.default,
      borderWidth: 2,
      borderRadius: 5,
      backgroundColor: '#fff',
      justifyContent: 'center',
      alignItems: 'center',
    },
  });
  

  return (
    <SafeAreaView style={{ flex: 1, backgroundColor: COLORS.primary }}>
    <StatusBar backgroundColor={COLORS.primary} />
    <FlatList
      ref={ref}
      onMomentumScrollEnd={updateCurrentSlideComponentIndex}
      contentContainerStyle={{ height: height * 0.75 }}
      showsHorizontalScrollIndicator={false}
      horizontal
      data={SlideComponents}
      pagingEnabled
      renderItem={({ item }) => <SlideComponentComponent item={item} />}
    />
    <Footer />
  </SafeAreaView>
  )
}
export default memo(m);