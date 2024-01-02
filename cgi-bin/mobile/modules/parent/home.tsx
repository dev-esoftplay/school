// withHooks
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { memo, useRef, useState, useEffect } from 'react';
import React from 'react';
import { Dimensions, FlatList, Image, Pressable, Text, View } from 'react-native';

// Props untuk komponen ParentsHome
export interface ParentsHomeProps {
  navigation: any;
}

// Data anak-anak dan kehadirannya
interface ChildData {
  nama: string;
  kelas: string;
  sekolah: string;
  image: any;
  kehadiran?: any[];
}

// Data kehadiran anak pada setiap slide
const slides: ChildData[] = [
  {
    nama: 'Naufal Dinaja',
    kelas: '12 PPLG 2',
    sekolah: 'SMK Rus Kudus',
    image: require('../../assets/naufal.png'),
    kehadiran: [
      {
        kategori: 'Hadir',
        value: 30,
        color: '#0DBD5E',
      },
      {
        kategori: 'Sakit',
        value: 10,
        color: '#F6C956',
      },
      {
        kategori: 'Izin',
        value: 5,
        color: '#0083FD',
      },
      {
        kategori: 'Alfa',
        value: 5,
        color: '#FF4343',
      },

    ]
  },
  {
    nama: 'Ilham Maulana',
    kelas: '12 PPLG 2',
    sekolah: 'SMK Rus Kudus',
    image: require('../../assets/roki.png'),
    kehadiran: [
      {
        kategori: 'Hadir',
        value: 30,
        color: '#0DBD5E',
      },
      {
        kategori: 'Sakit',
        value: 10,
        color: '#F6C956',
      },
      {
        kategori: 'Izin',
        value: 5,
        color: '#0083FD',
      },
      {
        kategori: 'Alfa',
        value: 5,
        color: '#FF4343',
      },

    ]
  },
  // Tambahkan data anak lainnya jika diperlukan
];

function shadows(value: number) {
  return {
    elevation: 3, // For Android
    shadowColor: '#000', // For iOS
    shadowOffset: { width: 1, height: 5 },
    shadowOpacity: 0.7,
    shadowRadius: value,
  }
}

// Komponen ParentsHome
function ParentsHome({ navigation }: ParentsHomeProps): JSX.Element {
  const { width, height } = Dimensions.get('window');
  const [currentSlideIndex, setCurrentSlideIndex] = useState(0);
  const ref = useRef<FlatList<ChildData>>(null);

  // Fungsi untuk memperbarui indeks slide saat digulirkan
  const updateCurrentSlideIndex = (e: any) => {
    const contentOffsetX = e.nativeEvent.contentOffset.x;
    const currentIndex = Math.round(contentOffsetX / width);
    setCurrentSlideIndex(currentIndex);
  };

  // Fungsi untuk pindah ke slide berikutnya
  const goToNextSlide = () => {
    const nextSlideIndex = currentSlideIndex + 1;
    const lastSlideIndex = slides.length - 1;

    if (nextSlideIndex <= lastSlideIndex) {
      const offset = nextSlideIndex * width;
      ref?.current?.scrollToOffset({ offset });
      setCurrentSlideIndex(nextSlideIndex);
    } else {
      // Jika sudah di slide terakhir, kembali ke slide pertama
      const offset = 0;
      ref?.current?.scrollToOffset({ offset });
      setCurrentSlideIndex(0);
    }
  };

  // // Efek untuk auto slide setiap beberapa detik
  // useEffect(() => {
  //   const interval = setInterval(goToNextSlide, 5000);

  //   // Membersihkan interval saat komponen tidak lagi digunakan
  //   return () => clearInterval(interval);
  // }, [currentSlideIndex]);

  return (
    <View style={{ flex: 1, backgroundColor: 'white' }}>
      {/* Kartu Orang Tua */}
      <View style={{ flex: 1, backgroundColor: '#3f71d4', justifyContent: 'flex-start', padding: 20, borderBottomRightRadius: 12, borderBottomLeftRadius: 12 }}>

        <View style={{ height: 120, justifyContent: 'flex-start', alignItems: 'center', marginVertical: 20, padding: 15, flexDirection: 'row', borderRadius: 12 }}>
          <Image source={require('../../assets/anies.png')} style={{ width: 100, height: 100, borderRadius: 50, borderWidth: 5, borderColor: 'white', justifyContent: 'center' }} />

          <View style={{ marginLeft: 20, alignItems: 'flex-start', justifyContent: 'center' }}>

            <Text style={{ fontSize: 20, color: 'white', textAlign: 'center' }}>Anies Rasyid Baswedan</Text>
            <Text style={{ fontSize: 20, color: 'white', textAlign: 'center' }}>Presiden RI 2024</Text>
          </View>
        </View>
      </View>

      {/* Kartu Aktivitas Anak */}
      <View style={{ flex: 3, backgroundColor: 'white', justifyContent: 'center', paddingLeft: 20, paddingTop: 20, alignItems: 'flex-start' }}>



        {/* Kartu Anak */}
        <FlatList
          ref={ref}
          onMomentumScrollEnd={updateCurrentSlideIndex}
          contentContainerStyle={{ height: height * 0.6, alignItems: 'center', backgroundColor: '#ffffff' }}
          showsHorizontalScrollIndicator={false}
          horizontal
          data={slides}
          pagingEnabled
          renderItem={({ item }) => (

            <View style={{ alignItems: 'center', width: width - 40, paddingBottom: 20, borderRadius: 12, backgroundColor: '#ffffff', marginRight: 20, justifyContent: 'center', height: height * 0.6, padding: 10 }}>

              <Pressable onPress={() => LibNavigation.navigate('parent/childdetail')} style={{backgroundColor:'green'}}>
                <View style={{ height: height * 0.54, backgroundColor: '#5374b4', width: width - 50, borderRadius: 12, marginTop: 10, ...shadows(3), paddingTop: 79 }}>

    
                  <View style={{ padding: 20, alignItems: 'center', backgroundColor: 'white', borderBottomLeftRadius: 12, borderBottomRightRadius: 12, height: height * 0.44 }}>
                    <Image
                      source={item.image}
                      style={{ width: 100, height: 100, borderRadius: 75, alignSelf: 'center', borderWidth: 2, borderColor: 'white', marginLeft: 10, position: 'absolute', top: -65 }} />
                    <View style={{ alignItems: 'center', marginTop: 20 }}>
                      <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'black' }}>{item.nama}</Text>
                      <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'black' }}>{item.kelas}</Text>
                      <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'black' }}>{item.sekolah}</Text>
                    </View>
                    {/* grid  daftar kehadiran */}
                    <FlatList
                      data={item.kehadiran}
                      numColumns={2} // Sesuaikan dengan jumlah kolom yang diinginkan
                      keyExtractor={(item, index) => index.toString()}
                      scrollEnabled={false}
                      contentContainerStyle={{ padding: 10, }}
                      renderItem={({ item: kehadiranItem }) => (
                        <View style={{ height: 80, width: '45%', alignItems: 'center', backgroundColor: kehadiranItem.color, justifyContent: 'center', borderRadius: 10, padding: 5, margin: '2.5%' }}>
                          <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{kehadiranItem.value}</Text>
                          <Text style={{ fontSize: 18, fontWeight: 'bold', color: 'white' }}>{kehadiranItem.kategori}</Text>
                        </View>
                      )} />
                  </View>


                </View>
              </Pressable>
              {/* slide indicator */}
              <View
                style={{
                  flexDirection: 'row',
                  justifyContent: 'center',
                  marginTop: 20,
                }}>
                {slides.map((_, index) => (
                  <View
                    key={index}
                    style={[
                      {
                        height: 15,
                        width: 30,
                        backgroundColor: '#757171',
                        marginHorizontal: 3,
                        borderRadius: 12,
                      },
                      currentSlideIndex === index && {
                        backgroundColor: '#36be9c',
                        width: 25,
                      },
                    ]}
                  />
                ))}
              </View>
            </View>
          )}
          onScroll={(e) => updateCurrentSlideIndex(e)}
          keyExtractor={(item, index) => index.toString()}
        />

      </View>
    </View>
  );
}

export default memo(ParentsHome);