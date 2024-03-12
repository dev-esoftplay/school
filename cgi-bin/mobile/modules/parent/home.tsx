// withHooks
import { memo } from 'react';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibPicture } from 'esoftplay/cache/lib/picture/import';
import esp from 'esoftplay/esp';
import { useRef, useState, useEffect } from 'react';
// import { LibStyle } from 'esoftplay/cache/lib/style/import';
import React from 'react';
import navigation from 'esoftplay/modules/lib/navigation';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { Dimensions, FlatList, Image, Pressable, Text, View } from 'react-native';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { useTimeout } from 'esoftplay/timeout';
import { Auth } from '../auth/login';
import { LibNotification } from 'esoftplay/cache/lib/notification/import';
import { UserClass } from 'esoftplay/cache/user/class/import';
// Props untuk komponen ParentsHome
export interface ParentsHomeProps {

}


function shadows(value: number) {
  return {
    elevation: 3, // For Android
    shadowColor: '#000', // For iOS
    shadowOffset: { width: 1, height: 5 },
    shadowOpacity: 0.7,
    shadowRadius: value,
  }
}

export function pushToken(): void {
  console.log("Api pushToken ...")
  AsyncStorage.getItem("token").then((token: any) => {
    if (token) {
      let post = { token: token }
      new LibCurl('user_token', post, (result, msg) => {
        console.log(token)
        console.log("result", result)
        console.log("msg", msg)
        UserClass?.pushToken()

      }, (error) => {
        console.log("error", error)
        console.log(token)
        AsyncStorage.removeItem("push_id")

      })
    }

  })
}
// Komponen ParentsHome
function ParentsHome({ }: ParentsHomeProps): JSX.Element {
  const { width, height } = Dimensions.get('window');
  const [currentSlideIndex, setCurrentSlideIndex] = useState(0);
  const ref = useRef<FlatList<any>>(null);

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

  const [ParentStudent, setParentStudent] = useState<any>([])

  const hitApi = () => { }

  function loadParentStudent() {
    new LibCurl('parent_student', get, (result, msg) => {
      setParentStudent(result)
    }, (err) => {
      console.log("error", err)
    }, 1)
  }


  // // Efek untuk auto slide setiap beberapaslides detik
  useEffect(() => {
    loadParentStudent();
  }, []);

  // Data anak-anak dan kehadirannya


  // Data kehadiran anak pada setiap slide
  const slides: [] = ParentStudent.student_data
  const timeout = useTimeout()

  const data = UserClass.state().useSelector(s => s)
  async function apilogout() {
    console.log('menjalankan apilogout....');
    esp.mod("lib/notification").requestPermission((token) => {
      console.log('token :..==', token);
      // const data = UserClass.state().useSelector(s => s)

      const post = { token: token }


      new LibCurl('logout', get, (result, msg) => {
        console.log('check post', post);
        console.log('check apikey', data.apikey);
        console.log('check uri', data.uri);
        console.log('result', result);
        console.log('msg', msg);


      }, (error) => {
        console.log('check post', post);
        console.log('check apikey', data.apikey);
        console.log('check uri', data.uri);
        console.log("api logout error :", error);
        console.log('apilogout');

      }, 1)
    }
    )
  }

  const logout = () => {
    console.log('menjalankan logout....');
    apilogout()
    timeout(() => {
      UserClass.pushToken()
      // pushToken()
      LibNotification.drop()
      Auth.reset()
      UserClass.delete()
      navigation.reset('auth/login')
    }, 1000)

  }
  return (
    <View style={{ flex: 1, backgroundColor: '#FFFFFF' }}>
      {/* Kartu Orang Tua */}
      <View style={{ flex: 1, backgroundColor: '#4B7AD6', justifyContent: 'flex-start', padding: 20, paddingTop: 40, borderBottomRightRadius: 12, borderBottomLeftRadius: 12 }}>

        <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#FFFFFF' }}>Selamat Datang,</Text>

        <Pressable onPress={() => { LibNavigation.navigate('parent/account') }}>


          <View style={{ backgroundColor: '#FFFFFF', height: 120, justifyContent: 'flex-start', alignItems: 'center', marginVertical: 20, padding: 15, flexDirection: 'row', borderRadius: 10 }}>
            <Image source={{ uri: ParentStudent.image ?? 'https://images.unsplash.com/photo-1507823782123-27db7f9fd196?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }} style={{ width: 105, height: 105, borderRadius: 135 / 2, borderWidth: 3, borderColor: '#FFFFFF' }} />
            <View style={{ marginLeft: 15, alignItems: 'flex-start', justifyContent: 'center' }}>
              <Text style={{ fontSize: 18, color: '#000000', textAlign: 'center', fontWeight: '600' }}>{ParentStudent.name}</Text>
              <Text style={{ fontSize: 18, color: '#000000', textAlign: 'center', fontWeight: '600' }}>+{ParentStudent.phone}</Text>
            </View>
          </View>

        </Pressable>
      </View>


      <View>
        <Text style={{ fontSize: 20, fontWeight: '600', marginTop: 15, marginLeft: 15 }}>Awasi aktivitas anak anda</Text>
      </View>

      {/* Kartu Aktivitas Anak */}
      <View style={{ flex: 3, backgroundColor: '#FFFFFF', justifyContent: 'center', paddingLeft: 20, paddingTop: 10, alignItems: 'flex-start' }}>

        {/* Kartu Anak */}
        <FlatList
          ref={ref}
          onMomentumScrollEnd={updateCurrentSlideIndex}
          contentContainerStyle={{ height: height * 0.6, alignItems: 'center', backgroundColor: '#ffffff' }}
          showsHorizontalScrollIndicator={false}
          horizontal
          data={ParentStudent.student_data}
          pagingEnabled
          keyExtractor={(item, index) => index.toString()}
          renderItem={({ item }) => {
            console.log('item:', JSON.stringify(item))
            console.log(item.class_name)

            return (
              <View style={{ alignItems: 'center', width: width - 40, paddingBottom: 20, borderRadius: 12, backgroundColor: '#ffffff', marginRight: 20, justifyContent: 'center', height: height * 0.8, padding: 10 }}>

                <Pressable onPress={() => LibNavigation.navigate('parent/childdetail')}>
                  <View style={{ height: height * 0.54, backgroundColor: '#4B7AD6', width: width - 50, borderRadius: 12, marginTop: 10, ...shadows(3), paddingTop: 79 }}>


                    <View style={{ padding: 20, alignItems: 'center', backgroundColor: '#FFFFFF', borderBottomLeftRadius: 12, borderBottomRightRadius: 12, height: height * 0.44 }}>
                      <Image
                        source={ParentStudent.image}
                      />

                      <View style={{ alignItems: 'center', marginTop: 10 }}>
                        <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#000000' }}>{item.student_name}</Text>
                        <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#000000' }}>{item.class_name}</Text>
                        <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#000000' }}>{item.nis}</Text>
                      </View>

                      {/* grid  daftar kehadiran */}
                      <View style={{ flexDirection: 'row', flexWrap: 'wrap', justifyContent: 'space-between', marginTop: 35 }}>
                        <View style={{ height: 80, width: '45%', alignItems: 'center', backgroundColor: '#0EBD5E', justifyContent: 'center', borderRadius: 10, padding: 5, margin: '2.5%' }}>
                          <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{item.student_attendance.hadir} </Text>
                          <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Hadir</Text>
                        </View>

                        <View style={{ height: 80, width: '45%', alignItems: 'center', backgroundColor: '#F6C856', justifyContent: 'center', borderRadius: 10, padding: 5, margin: '2.5%' }}>
                          <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{item.student_attendance.sakit} </Text>
                          <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Sakit</Text>
                        </View>

                        <View style={{ height: 80, width: '45%', alignItems: 'center', backgroundColor: '#0083FD', justifyContent: 'center', borderRadius: 10, padding: 5, margin: '2.5%' }}>
                          <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{item.student_attendance.sakit} </Text>
                          <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Izin</Text>
                        </View>

                        <View style={{ height: 80, width: '45%', alignItems: 'center', backgroundColor: '#FF4342', justifyContent: 'center', borderRadius: 10, padding: 5, margin: '2.5%' }}>
                          <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{item.student_attendance.sakit} </Text>
                          <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Alfa</Text>
                        </View>

                      </View>
                    </View>
                  </View>
                </Pressable>
                {/* slide indicator */}
                <View
                  style={{
                    flexDirection: 'row',
                    justifyContent: 'center',
                    marginTop: 10,
                  }}>
                </View>

              </View>
            )
          }}
          onScroll={(e) => updateCurrentSlideIndex(e)}

        />

        {/* <View style={{ flexDirection: "row", alignContent: 'center', justifyContent: 'center', width: LibStyle.width }}>
          <View style={{ flexDirection: "row", width: LibStyle.width / 4 }}>
            {ParentStudent.student_data.map((_: any, index: React.Key | null | undefined) => (
              <View
                key={index}
                style={[
                  {
                    height: 15,
                    width: 20,
                    backgroundColor: '#757171',
                    marginHorizontal: 3,
                    borderRadius: 12,
                  },
                  currentSlideIndex === index && {
                    backgroundColor: '#3F8DFD',
                    width: 35,
                  },
                ]}
              />
            ))}
          </View>
        </View> */}

      </View>
    </View>
  );
}

export default memo(ParentsHome);