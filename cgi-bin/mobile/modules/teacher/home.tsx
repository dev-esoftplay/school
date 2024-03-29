// withHooks
import { memo } from 'react';
import { useEffect } from 'react';

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
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { Colors } from 'react-native/Libraries/NewAppScreen';
import * as Notifications from 'expo-notifications';
import SchoolColors from '../utils/schoolcolor';
import { LibUtils } from 'esoftplay/cache/lib/utils/import';
import { LibList } from 'esoftplay/cache/lib/list/import';

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

function m(): any {


  //mengambil data dari userClass
  const data = UserClass.state().get()
  const school = new SchoolColors()
  const [TeacherSchadule, setTeacherSchadule] = useSafeState<any>();
  const [TeacherSchadule2, setTeacherSchadule2] = useSafeState<any>();
  let [TeacherSchaduleLIst, setTeacherSchaduleLIst] = useSafeState<any>([]);
  const [profil, setProfil] = useSafeState<any>();
  const [teacher_id, setTeacher_id] = useSafeState<any>(0);
  const allTabs = ['Today Schadule', 'Tomorrow Schadule'];
  const [selectTab, setSelectTab] = useSafeState(allTabs[0])



  useEffect(() => {
    console.log('data user', data)
    // console.log('apikey in page home', apikey)

    new LibCurl('teacher', null, (result, msg) => {
      esp.log({ result, msg });
      console.log("result profil", result)
      setTeacher_id(result.teacher_id)
      setProfil(result)
    }, (err) => {
      esp.log({ err });
      LibDialog.warning('get data gagal', err?.message)
    })

    new LibCurl('teacher_schedule', null,
      (result) => {
        // console.log('Jadwal Result:', result);
        // console.log("msg", msg)
        setTeacherSchadule(result)
        setTeacherSchaduleLIst(result?.schedule)

      },
      () => {
        // console.log("error", err)
      })

    let TommorowDate = moment().add(1, "days").format('YYYY-MM-DD');
    // get schadule tomorrow from api
    console.log('TommorowDate', TommorowDate)
    new LibCurl('teacher_schedule?date=' + TommorowDate, null, (result) => {

      // console.log('Jadwal Result besok:', JSON.stringify(result));

      // console.log("msg", msg)
      setTeacherSchadule2(result)
    }, () => {
      // console.log("error", err)
    })
  }, [])


  const refresh = () => {




    LibUtils.debounce(() => {

      new LibCurl('teacher', null, (result, msg) => {
        esp.log({ result, msg });
        console.log("teacher id", result.teacher_id)
        console.log("result profil", result)
        setProfil(result)
      }, (err) => {
        esp.log({ err });
        LibDialog.warning('get data gagal', err?.message)
      })

      new LibCurl('teacher_schedule', null,
        (result) => {
          // console.log('Jadwal Result:', result);
          // console.log("msg", msg)
          setTeacherSchadule(result)
          setTeacherSchaduleLIst(result?.schedule)
          setSelectTab(allTabs[0])
        },
        () => {
          // console.log("error", err)
        })
      let TommorowDate = moment().add(1, "days").format('YYYY-MM-DD');
      // get schadule tomorrow from api
      new LibCurl('teacher_schedule?date=' + TommorowDate, null, (result) => {
        console.log('Jadwal Result besok:', result);
        // console.log("msg", msg)
        setTeacherSchadule2(result)
      }, () => {
        // console.log("error", err)
      })


    }, 100)


  }

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
        return "gray"
    }
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

  function Elevation(value: number) {

    return {
      elevation: 3, // For Android
      shadowColor: '#000', // For iOS
      shadowOffset: { width: 2, height: 1 },
      shadowOpacity: 3,
      shadowRadius: 4,
    }
  }

  const Profilpic = () => {
    if (profil) {
      return (
        <View style={{ flexDirection: 'row', backgroundColor: 'white', alignItems: 'center', marginTop: 10, justifyContent: 'space-between', paddingHorizontal: 5 }}>

          <View style={{}}>

            {/* {apikey} */}
            <Text style={{ fontSize: 28, fontWeight: 'bold', color: 'black' }}>Selamat datang</Text>
            <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black' }}>{profil?.name ?? 'shh'}</Text>
          </View>
          <LibPicture
            source={{ uri: profil?.image }}
            style={{ width: 100, height: 100, borderRadius: 50, borderColor: school.primary, borderWidth: 2 }}
          />
        </View>)


    } else {
      return (
        <View style={{ flexDirection: 'row', marginTop: 10, height: 'auto', justifyContent: 'space-between' }}>



          <View style={{ height: 'auto', borderRadius: 12, marginHorizontal: 10, marginVertical: 10 }}>

            <LibSkeleton duration={1000} colors={['gray', '#a59797', '#494040']} backgroundStyle={Colors}>
              <View style={{ height: 30, backgroundColor: 'white', padding: 10, ...Elevation(7), borderRadius: 12, width: 50 }} />
            </LibSkeleton>
            <LibSkeleton duration={1000} colors={['gray', '#a59797', '#494040']} >
              <View style={{ height: 30, backgroundColor: 'white', padding: 10, ...Elevation(7), borderRadius: 12, width: 80 }} />
            </LibSkeleton>
          </View>

          <View style={{ width: 100, height: 100, borderRadius: 50, backgroundColor: 'gray', justifyContent: 'center', alignItems: 'center' }} />

        </View>
      )


    }

  }
  return (
    <View style={{ flex: 1, backgroundColor: '#ffffffff', padding: 10, marginTop: LibStyle.STATUSBAR_HEIGHT }}>
      <LibList
        data={(TeacherSchaduleLIst || [])}
        onRefresh={refresh}
        ListHeaderComponent={() => {
          return (
            <View style={{ justifyContent: 'center', margin: 5, }}>
              <Profilpic />
              <View style={{
                flexDirection: 'row', marginTop: 25, justifyContent: 'space-between', flex: 1, paddingHorizontal: 5, marginBottom: 1
              }}>
                <TouchableOpacity
                  style={{
                    paddingVertical: 10, backgroundColor: selectTab === allTabs[0] ? school.primary : '#FFFFFF',
                    justifyContent: 'center', alignItems: 'center', ...LibStyle.elevation(3), flex: 1, borderBottomLeftRadius: 10, borderTopLeftRadius: 10,
                  }} onPress={() => { setSelectTab(allTabs[0]), setTeacherSchaduleLIst(TeacherSchadule.schedule) }} key={0}>
                  {/* nanti curl ke Today Schadule*/}

                  <Text style={{ fontSize: 18, fontWeight: 'bold', color: selectTab == allTabs[0] ? 'white' : school.primary, textAlign: 'center' }}>Jadwal hari {TeacherSchadule?.day ?? 'hari'} </Text>

                </TouchableOpacity>
                <TouchableOpacity style={{
                  paddingVertical: 10, backgroundColor: selectTab === allTabs[1] ? school.primary : '#FFFFFF',
                  justifyContent: 'center', alignItems: 'center', ...LibStyle.elevation(3), flex: 1, borderBottomRightRadius: 10, borderTopRightRadius: 10,
                }} onPress={() => { setSelectTab(allTabs[1]), setTeacherSchaduleLIst(TeacherSchadule2.schedule) }} key={1}>
                  {/* nanti curl ke Tommorow*/}
                  <Text style={{ fontSize: 18, fontWeight: 'bold', color: selectTab == allTabs[1] ? 'white' : school.primary, textAlign: 'center', }}>Jadwal Besok</Text>
                </TouchableOpacity>
              </View>
            </View>
          )
        }}
        ListEmptyComponent={() => {

          return (
            <View style={{ flex: 1, }}>
              {Array.from({ length: 7 }, (_, index) => (
                <View key={index} style={{ height: 120, marginHorizontal: 10, marginVertical: 5, paddingVertical: 10 }}>
                  <View style={{ height: 25, backgroundColor: '#a59797', padding: 10, ...LibStyle.elevation(2), borderRadius: 5, marginBottom: 10, width: 80 }} />
                  <LibSkeleton duration={1000} colors={['gray', '#a59797', '#dbd1d1']} reverse={true}>
                    <View style={{ height: 60, backgroundColor: 'white', padding: 5, ...LibStyle.elevation(2), borderRadius: 5 }} />
                  </LibSkeleton>
                </View>
              ))}
            </View>
          )
        }}
        renderItem={(item: any) => {
          return (
            <View style={{ justifyContent: 'center', alignItems: 'flex-start', margin: 5, }}>
              <Text style={{ marginLeft: 5, fontSize: 15 }}>{item.status_text}</Text>
              {item.data.map((item: any) => {
                return (
                  <Pressable onPress={() => item?.status != 5 ? LibNavigation.navigate('teacher/attandence', { schedule_id: item?.schedule_id, class_id: item.class.id, courseId: item?.course.id, status: item.status, teacher_id: teacher_id }) : LibDialog.failed('absen', 'Belum waktunya Absen')} style={{ borderRadius: 8, marginVertical: 5, paddingHorizontal: 5 }} >

                    <View style={{ backgroundColor: statusColor(item?.status), borderRadius: 10, flexDirection: 'row', borderWidth: 2, borderColor: statusColor(item?.status), ...LibStyle.elevation(4), }}>

                      <View style={{ backgroundColor: '#ffffffff', padding: 5, marginLeft: 20, width: '85%', }}>

                        <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                          <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item?.class?.name ?? "kelas"} </Text>
                          <View style={{ height: 30, width: 'auto', justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10 }}>

                            <Text style={{ fontSize: 15, fontWeight: 'bold', color: studentStatus_color(item?.status) }}>{item?.student_attend} / {item?.student_number}</Text>
                          </View>
                        </View>

                        <View style={{ height: 15, }} />
                        <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                          <Text style={{ fontSize: 15, fontWeight: 'bold', color: '#696969' }}>{item?.course?.name}</Text>
                          <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item?.clock_start}-{item?.clock_end}</Text>
                        </View>
                      </View>

                      <LibIcon.AntDesign name="right" size={25} color="white" style={{ alignSelf: 'center', marginLeft: 5 }} />

                    </View>
                  </Pressable>
                )
              })}
            </View>
          )
        }} />




    </View>
  )
}



export default memo(m);