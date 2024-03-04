// withHooks
import { useRef } from 'react';
import { useEffect, useState } from 'react';

import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibPicture } from 'esoftplay/cache/lib/picture/import';
import { LibSkeleton } from 'esoftplay/cache/lib/skeleton/import';
import { UserClass } from 'esoftplay/cache/user/class/import';
import esp from 'esoftplay/esp';
import moment from 'esoftplay/moment';
import useSafeState from 'esoftplay/state';
import React from 'react';
import { Pressable, Text, TouchableOpacity, View } from 'react-native';
import { FlatList, ScrollView } from 'react-native-gesture-handler';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { Colors } from 'react-native/Libraries/NewAppScreen';
import * as Notifications from 'expo-notifications';
import SchoolColors from '../utils/schoolcolor';

export interface TeacherHomeArgs {

}
export interface TeacherHomeProps {

}
Notifications.setNotificationHandler({
  handleNotification: async () => ({
    shouldShowAlert: true,
    shouldPlaySound: true,
    shouldSetBadge: false,
  }),
});

export default function m(props: TeacherHomeProps): any {


  //mengambil data dari userClass
  const data = UserClass.state().get()
  const school = new SchoolColors()
  const [ApiResponse, setResApi] = useSafeState<any>();
  const [ApiResponse2, setResApi2] = useSafeState<any>();
  const [profil, setProfil] = useSafeState<any>();
  const allTabs = ['Today Schadule', 'Tomorrow Schadule'];
  const [selectTab, setSelectTab] = React.useState(allTabs[0])

 

  useEffect(() => {
    console.log('data user', data)
    const url: string = "http://api.school.lc/teacher_schedule"
    // console.log('apikey in page home', apikey)

    new LibCurl('teacher', get, (result, msg) => {
      esp.log({ result, msg });
      console.log("result profil", result)
      setProfil(result)
    }, (err) => {
      esp.log({ err });
      LibDialog.warning('get data gagal', err?.message)
    })

    new LibCurl('teacher_schedule', get,
      (result, msg) => {
        // console.log('Jadwal Result:', result);
        // console.log("msg", msg)
        setResApi(result)

      },
      (err) => {
        // console.log("error", err)
      })

    let TommorowDate = moment().add(1, "days").format('YYYY-MM-DD');
    // console.log("TommorowDate", TommorowDate)
    let CurrentDate = moment().format('YYYY-MM-DD');
    // console.log("CurrentDate", CurrentDate)

    // get schadule tomorrow from api
    let url1: string = 'http://api.school.lc/teacher_schedule?date=' + TommorowDate
    new LibCurl('teacher_schedule?date=' + TommorowDate, get, (result, msg) => {
      console.log('Jadwal Result besok:', result);
      console.log(result.schedule[0].class.name)
      // console.log("msg", msg)
      setResApi2(result)
    }, (err) => {
      // console.log("error", err)
    })
  }, [])

  function convertClockEndTimeToSeconds(clock_end:string) {
    // Parsing string waktu menjadi jam dan menit
    const [hours, minutes] = clock_end.split(':').map(Number);

    // Mengonversi jam dan menit menjadi jumlah detik
    const totalSeconds = hours * 3600 + minutes * 60;

    return totalSeconds;
}
  //  async function latenotif(status: number, clock_end: any) {
      

  //     const currentTime = moment().format('HH:mm');
  //     const second_end = convertClockEndTimeToSeconds(clock_end);
  //     const second_current = convertClockEndTimeToSeconds(currentTime);
  //     console.log("second_end", second_end)
  //     console.log("second_current", second_current)
  //   if (status == 3 ) {
  //     console.log("masuk waktu", clock_end>=currentTime)
  //         console.log('clock_end :'+clock_end + ' currentTime :'+currentTime)
  //           return  await Notifications.scheduleNotificationAsync({
  //             content: {
  //                 title: "Waktu yang diinput telah lewat",
  //                 body: `Waktu ${clock_end} telah lewat.`,
  //                 data: { data: 'goes here' },
  //             },
  //             trigger: null, // Notifikasi akan muncul langsung
  //         });
  //       }
  //  }
  const studentStatus_color = (status: number) => {
    switch (status) {
      case 1:
        return "green"
      case 2:
        return "orange"
      case 3:
        return "gray"
      case 4:
        return "gray"
      case 5:
        return "gray"
      default:
        return "gray"}
  }
  const statusColor = (status: number) => {
    // 1 completed
    // 2 fnished
    // 3 late
    // 4 ongoing
    // 5 notyet
    switch (status) {

      case 1:
        return "green"
      case 2:
        return "green"
      case 3:
        return "red"
      case 4:
        return "orange"
      case 5:
        return "gray"
      default:
        return "gray"
    }
  }

 

  
  function Bayangan(value: number) {
   
    return {
      elevation: 3, // For Android
      shadowColor: '#000', // For iOS
      shadowOffset: { width: 2, height: 1 },
      shadowOpacity: 3,
      shadowRadius: 4,
    }
  }
  const Tab = () => {
    let TommorowDate = moment().add(1, "days").format('YYYY-MM-DD');
    // console.log("TommorowDate", TommorowDate)
    let CurrentDate = moment().format('YYYY-MM-DD');
    // console.log("CurrentDate", CurrentDate)
    if (selectTab === allTabs[0]) {
      //jadwal hari ini
      if (ApiResponse?.schedule.length != null) {
        
        return (
          <FlatList data={ApiResponse?.schedule}
            style={{ height: 'auto', }}
            contentContainerStyle={{ paddingBottom: 20 }}
            showsVerticalScrollIndicator={false}
            keyExtractor={(item, index) => index.toString()}
            renderItem={
              ({ item }) => {
                // console.log("jmlh siswa", item?.student_attend ?? "0"+ "/" + item?.student_attend??'0' )
                // latenotif(item.status, item.clock_end)
                return (
                   
                    <Pressable onPress={() => item.status!=5 ?LibNavigation.navigate('teacher/attandence', { data: item.schedule_id, idclass: item.class.id, courseId: item.course.id }): LibDialog.failed('absen','Belum waktunya Absen')} style={{ ...Bayangan(5),borderRadius: 8,marginVertical:10,marginHorizontal:5}} >
                      <View style={{ backgroundColor: statusColor(item.status), borderRadius: 10, flexDirection: 'row', elevation: 8, }}>

                        <View style={{ backgroundColor: '#ffffff9f', padding: 10, marginLeft: 20, width: '85%', }}>

                          <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item?.class?.name ?? "kelas"} {item?.schedule_id ?? '0'}</Text>
                            <View style={{ height: 30, width: 'auto', borderRadius: 8, backgroundColor: studentStatus_color(item?.status), justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10 }}>

                              <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.student_attend} / {item.student_number}</Text>
                            </View>
                          </View>

                          <View style={{ height: 30, }} />
                          <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item.clock_start ?? ""}</Text>
                            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item.clock_end ?? ""}</Text>
                          </View>
                        </View>

                        <LibIcon.AntDesign name="right" size={25} color="white" style={{ alignSelf: 'center', marginLeft: 5 }} />

                      </View>
                    </Pressable>
             
                )
              }
            } />
        )

      } else {
        return (
          <View style={{ flex: 1, }}>
            {Array.from({ length: 7 }, (_, index) => (
              <View key={index} style={{ height: 100, borderRadius: 12, marginHorizontal: 10, marginVertical: 10 }}>

                <LibSkeleton duration={1000} colors={['gray', '#a59797', '#dbd1d1']} reverse={true}>
                  <View key={index} style={{ height: 100, backgroundColor: 'white', padding: 10, ...Bayangan(7), borderRadius: 12 }} />
                </LibSkeleton>
              </View>
            ))}
          </View>
        )
      }
    } else {
      return (
        <View>
          {/* <Text>Tanggal Hari ini {CurrentDate}</Text>
          <Text>Cek Tanggal Besok {TommorowDate}</Text> */}

          <FlatList data={ApiResponse2?.schedule ?? []}
            style={{ height: 'auto', }}
            showsVerticalScrollIndicator={false}
            keyExtractor={(item, index) => index.toString()}
            renderItem={
              ({ item }) => {
                console.log("item", item)
                //<Text>{item['subject_id']['class_id'].major}</Text>
                return (
                  <Pressable onPress={() => console.log("test")} style={{ backgroundColor: "gray", borderRadius: 10, marginTop: 10, flexDirection: 'row', }}>

                    <View style={{ backgroundColor: 'white', padding: 10, marginLeft: 30, width: '80%', opacity: 0.7 }}>

                      <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                        <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item.class.name ?? "kelas"}</Text>
                        <View style={{ height: 30, width: 'auto', borderRadius: 8, backgroundColor: "gray", justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10 }}>

                          <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.student_number + "/" + item.student_attend ?? "jumlah siswa"}</Text>
                        </View>
                      </View>

                      <View style={{ height: 30, }} />
                      <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                        <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item.clock_start ?? ""}</Text>
                        <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item.clock_end ?? ""}</Text>
                      </View>
                    </View>

                    <LibIcon.AntDesign name="right" size={25} color="white" style={{ alignSelf: 'center', marginLeft: 10 }} />

                  </Pressable>
                )
              }
            } />
        </View>
      )
    }
  }

  const Profilpic = () => {
    if (profil) {
      return (
        <View style={{ flexDirection: 'row', backgroundColor: 'white', alignItems: 'center', marginTop: 10,justifyContent:'space-between'}}>

          <View style={{ }}>

            {/* {apikey} */}
            <Text style={{ fontSize: 28, fontWeight: 'bold', color: 'black' }}>Selamat datang</Text>
            <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black' }}>{profil?.name ?? 'shh'}</Text>
          </View>
          <LibPicture
            source={{ uri: profil?.image }}
            style={{ width: 100, height: 100, borderRadius: 50,borderColor: school.primary,borderWidth:2  }}
          />
        </View>)


    } else {
      return (
        <View style={{ flexDirection: 'row', marginTop: 10, height: 'auto',justifyContent:'space-between' }}>

          

          <View style={{ height: 'auto', borderRadius: 12, marginHorizontal: 10, marginVertical: 10 }}>

            <LibSkeleton duration={1000} colors={['gray', '#a59797', '#494040']} backgroundStyle={Colors}>
              <View style={{ height: 30, backgroundColor: 'white', padding: 10, ...Bayangan(7), borderRadius: 12, width: 50 }} />
            </LibSkeleton>
            <LibSkeleton duration={1000} colors={['gray', '#a59797', '#494040']} >
              <View style={{ height: 30, backgroundColor: 'white', padding: 10, ...Bayangan(7), borderRadius: 12, width: 80 }} />
            </LibSkeleton>
          </View>
          
          <View style={{ width: 100, height: 100, borderRadius: 50, backgroundColor: 'gray', justifyContent: 'center', alignItems: 'center' }}/>

        </View>
      )


    }

  }
  return (
    <View style={{ flex: 1, backgroundColor: 'white', padding: 10, marginTop: LibStyle.STATUSBAR_HEIGHT }}>

      <ScrollView showsVerticalScrollIndicator={false}>

        {/* welcome card */}
        <Profilpic />
        {/* schadule Tab */}

        <View style={{ flexDirection: 'row', backgroundColor: '#ffffff', alignItems: 'center', marginTop: 25, justifyContent: 'space-between' }}>
          <TouchableOpacity style={{ alignSelf: 'center', }} onPress={() => setSelectTab(allTabs[0])} key={0}>
            {/* nanti curl ke Today Schadule*/}
            <Text style={{ fontSize: 18, fontWeight: 'bold', color: selectTab == allTabs[0] ? 'green':'black', textAlign: 'center' }}>Jadwal hari {ApiResponse?.day ?? 'hari'} </Text>
          </TouchableOpacity>
          <TouchableOpacity style={{ alignSelf: 'center', }} onPress={() => setSelectTab(allTabs[1])} key={1}>
            {/* nanti curl ke Tommorow*/}
            <Text style={{ fontSize: 18, fontWeight: 'bold', color: selectTab == allTabs[1] ? 'green' : 'black', textAlign: 'center', }}>Besok</Text>
          </TouchableOpacity>
        </View>

        <Tab />
      </ScrollView>


    </View>
  )
}


